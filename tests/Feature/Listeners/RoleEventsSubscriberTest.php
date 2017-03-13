<?php

namespace Tests\Feature\Listeners;

use SPCVN\Events\Role\Created;
use SPCVN\Events\Role\Deleted;
use SPCVN\Events\Role\PermissionsUpdated;
use SPCVN\Events\Role\Updated;

class RoleEventsSubscriberTest extends BaseListenerTestCase
{
    protected $role;

    public function setUp()
    {
        parent::setUp();
        $this->role = factory(\SPCVN\Role::class)->create();
    }

    public function test_onCreate()
    {
        event(new Created($this->role));
        $this->assertMessageLogged("Created new role called {$this->role->display_name}.");
    }

    public function test_onUpdate()
    {
        event(new Updated($this->role));
        $this->assertMessageLogged("Updated role with name {$this->role->display_name}.");
    }

    public function test_onDelete()
    {
        event(new Deleted($this->role));
        $this->assertMessageLogged("Deleted role named {$this->role->display_name}.");
    }

    public function test_onPermissionsUpdate()
    {
        event(new PermissionsUpdated($this->role));
        $this->assertMessageLogged("Updated role permissions.");
    }

}
