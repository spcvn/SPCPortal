<?php

use SPCVN\Repositories\User\EloquentUser;
use SPCVN\Role;
use SPCVN\Support\Enum\UserStatus;
use SPCVN\User;
use Carbon\Carbon;
use Mockery as m;

class EloquentUserTest extends FunctionalTestCase
{
    /**
     * @var EloquentUser
     */
    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(EloquentUser::class);
    }

    public function test_find()
    {
        $user = factory(User::class)->create();

        $this->assertArraySubset(
            $user->toArray(),
            $this->repo->find($user->id)->toArray()
        );

        $this->assertNull($this->repo->find(123));
    }

    public function test_findByEmail()
    {
        $user = factory(User::class)->create();

        $this->assertArraySubset(
            $user->toArray(),
            $this->repo->findByEmail($user->email)->toArray()
        );

        $this->assertNull($this->repo->findByEmail('foo@bar.com'));
    }

    public function test_findBySocialId()
    {
        $user = factory(User::class)->create();

        DB::table('social_logins')->insert([
            'user_id' => $user->id,
            'provider' => 'foo',
            'provider_id' => '123',
            'avatar' => '',
            'created_at' => Carbon::now()
        ]);

        $this->assertArraySubset(
            $user->toArray(),
            $this->repo->findBySocialId('foo', '123')->toArray()
        );

        $this->assertNull($this->repo->findBySocialId('bar', '111'));
    }

    public function test_create()
    {
        $data = factory(User::class)->make()->toArray();

        $this->repo->create($data + ['password' => 'foo']);

        $this->seeInDatabase('users', $data);
    }

    public function test_associateSocialAccountForUser()
    {
        $user = factory(User::class)->create();

        Carbon::setTestNow(Carbon::now());

        $socialUser = new \Laravel\Socialite\One\User();
        $socialUser->map(['id' => '123', 'avatar' => 'foo']);

        $this->repo->associateSocialAccountForUser($user->id, 'facebook', $socialUser);

        $this->seeInDatabase('social_logins', [
            'user_id' => $user->id,
            'provider' => 'facebook',
            'provider_id' => '123',
            'avatar' => 'foo',
            'created_at' => Carbon::now()
        ]);

        Carbon::setTestNow(null);
    }

    public function test_paginate()
    {
        $users = factory(User::class)->times(5)->create();

        $result = $this->repo->paginate(2)->toArray();

        $this->assertEquals(2, count($result['data']));
        $this->assertEquals(5, $result['total']);
        $this->assertArraySubset($users[0]->toArray(), $result['data'][0]);
        $this->assertArraySubset($users[1]->toArray(), $result['data'][1]);
    }

    public function test_paginate_with_status()
    {
        factory(User::class)->times(3)->create();
        factory(User::class)->create(['status' => UserStatus::BANNED]);

        $active = $this->repo->paginate(2, null, UserStatus::ACTIVE)->toArray();
        $banned = $this->repo->paginate(2, null, UserStatus::BANNED)->toArray();

        $this->assertEquals(2, count($active['data']));
        $this->assertEquals(3, $active['total']);

        $this->assertEquals(1, count($banned['data']));
        $this->assertEquals(1, $banned['total']);
    }

    public function test_paginate_with_search()
    {
        factory(User::class)->create(['first_name' => 'John', 'last_name' => 'Doe', 'username' => 'jdoe', 'email' => 'joe@test.com']);
        factory(User::class)->create(['first_name' => 'Jane', 'last_name' => 'Doe', 'username' => 'janedoe', 'email' => 'jane@doe.com']);
        factory(User::class)->create(['first_name' => 'Milos', 'last_name' => 'Stojanovic', 'email' => 'test@test.com']);

        $this->assertEquals(2, $this->repo->paginate(25, 'doe')->total());
        $this->assertEquals(1, $this->repo->paginate(25, 'Milos')->total());
        $this->assertEquals(2, $this->repo->paginate(25, 'test')->total());
        $this->assertEquals(2, $this->repo->paginate(25, 'an')->total());
    }

    public function test_update()
    {
        $user = factory(User::class)->create();

        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'foo',
            'email' => 'test@test.com'
        ];

        $this->repo->update($user->id, $data);

        $this->seeInDatabase('users', $data + ['id' => $user->id]);
    }

    public function test_updateSocialNetworks()
    {
        $user = factory(User::class)->create();

        $data = [
            'facebook' => 'foo',
            'twitter' => 'bar',
            'dribbble' => 'bazz',
            'skype' => 'skyyyype',
            'linked_in' => 'li',
            'google_plus' => 'g+'
        ];

        $this->repo->updateSocialNetworks($user->id, $data);

        $this->seeInDatabase('user_social_networks', $data + ['user_id' => $user->id]);
    }

    public function test_delete()
    {
        $user = factory(User::class)->create();

        $this->repo->delete($user->id);

        $this->notSeeInDatabase('users', ['id' => $user->id]);
    }

    public function test_count()
    {
        factory(User::class)->times(7)->create();

        $this->assertEquals(7, $this->repo->count());
    }

    public function test_newUsersCount()
    {
        Carbon::setTestNow(Carbon::now()->subMonth());
        factory(User::class)->times(3)->create();

        Carbon::setTestNow(null);
        factory(User::class)->times(5)->create();

        $this->assertEquals(5, $this->repo->newUsersCount());
    }

    public function test_countByStatus()
    {
        factory(User::class)->times(3)->create();
        factory(User::class)->create(['status' => UserStatus::BANNED]);
        factory(User::class)->times(2)->create(['status' => UserStatus::UNCONFIRMED]);

        $this->assertEquals(3, $this->repo->countByStatus(UserStatus::ACTIVE));
        $this->assertEquals(1, $this->repo->countByStatus(UserStatus::BANNED));
        $this->assertEquals(2, $this->repo->countByStatus(UserStatus::UNCONFIRMED));
    }

    public function test_latest()
    {
        Carbon::setTestNow(Carbon::now()->subDay());
        $user1 = factory(User::class)->create();

        Carbon::setTestNow(null);
        $users = factory(User::class)->times(3)->create();

        $latestTwo = $this->repo->latest(2);
        $latestFour = $this->repo->latest(4);

        $this->assertEquals(2, count($latestTwo));
        $this->assertEquals(4, count($latestFour));

        $this->assertArraySubset($users[0]->toArray(), $latestTwo[0]->toArray());
        $this->assertArraySubset($users[1]->toArray(), $latestTwo[1]->toArray());
        $this->assertArraySubset($user1->toArray(), $latestFour[3]->toArray());
    }

    public function test_countOfNewUsersPerMonth()
    {
        Carbon::setTestNow(Carbon::now()->startOfYear());
        factory(User::class)->times(2)->create();

        Carbon::setTestNow(Carbon::now()->startOfYear()->addMonths(2));
        factory(User::class)->times(4)->create();

        Carbon::setTestNow(Carbon::now()->startOfYear()->addMonths(6));
        factory(User::class)->times(2)->create();

        Carbon::setTestNow(Carbon::now()->startOfYear()->addMonths(7));
        factory(User::class)->times(1)->create();

        Carbon::setTestNow(Carbon::now()->startOfYear()->addMonths(10));
        factory(User::class)->times(4)->create();

        Carbon::setTestNow(null);

        $expected = [
            'January' => 2,
            'February' => 0,
            'March' => 4,
            'April' => 0,
            'May' => 0,
            'June' => 0,
            'July' => 2,
            'August' => 1,
            'September' => 0,
            'October' => 0,
            'November' => 4,
            'December' => 0
        ];

        $usersPerMonth = $this->repo->countOfNewUsersPerMonth(
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear()
        );

        $this->assertEquals($expected, $usersPerMonth);
    }

    public function test_getUsersWithRole()
    {
        $admins = factory(User::class)->times(2)->create();
        $role = Role::where('name', 'Admin')->first();
        $role->users()->attach($admins->pluck('id')->toArray());

        $user = factory(User::class)->create();
        $role = Role::where('name', 'User')->first();
        $role->users()->attach($user->id);

        $result = $this->repo->getUsersWithRole('Admin');
        $this->assertEquals(2, $result->count());
        $this->assertArraySubset($admins[0]->toArray(), $result[0]->toArray());
        $this->assertArraySubset($admins[1]->toArray(), $result[1]->toArray());

        $result = $this->repo->getUsersWithRole('User');
        $this->assertEquals(1, $result->count());
        $this->assertArraySubset($user->toArray(), $result[0]->toArray());
    }

    public function test_setRole()
    {
        $user = factory(User::class)->create();
        $role = Role::where('name', 'Admin')->first();

        $this->repo->setRole($user->id, $role->id);

        $this->seeInDatabase('role_user', [
           'role_id' => $role->id,
            'user_id' => $user->id
        ]);
    }

    public function test_switchRolesForUsers()
    {
        $role = Role::where('name', 'User')->first();
        $roleAdmin = Role::where('name', 'Admin')->first();

        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->setRoleForUser($user1, 'User');
        $this->setRoleForUser($user2, 'User');

        $this->repo->switchRolesForUsers($role->id, $roleAdmin->id);

        $this->seeInDatabase('role_user', [
            'role_id' => $roleAdmin->id,
            'user_id' => $user1->id
        ]);

        $this->seeInDatabase('role_user', [
            'role_id' => $roleAdmin->id,
            'user_id' => $user2->id
        ]);
    }
}
