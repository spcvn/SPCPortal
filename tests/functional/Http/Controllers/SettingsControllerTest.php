<?php

class SettingsControllerTest extends FunctionalTestCase
{
    public function test_update_app_name()
    {
        $user = $this->createSuperUser();
        $this->be($user);

        $oldName = Settings::get('app_name', 'SPCVN');

        Settings::set('app_name', 'bar');

        $name = 'foo';

        $this->visit('settings')
            ->seeInField('app_name', 'bar')
            ->type('foo', 'app_name')
            ->press('Update Settings');

        $this->assertEquals($name, Settings::get('app_name'));

        $this->visit('logout')
            ->seeInElement("#footer p", $name);

        Settings::set('app_name', $oldName);
        Settings::save();
    }
}
