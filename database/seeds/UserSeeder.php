<?php

use SPCVN\Role;
use SPCVN\Support\Enum\UserStatus;
use SPCVN\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'SPCVN',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => '123456',
            'avatar' => null,
            'country_id' => null,
            'status' => UserStatus::ACTIVE
        ]);

        $admin = Role::where('name', 'Admin')->first();

        $user->attachRole($admin);
        $user->socialNetworks()->create([]);
    }
}
