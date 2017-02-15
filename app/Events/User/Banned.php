<?php

namespace SPCVN\Events\User;

use SPCVN\User;

class Banned
{
    /**
     * @var User
     */
    protected $bannedUser;

    public function __construct(User $bannedUser)
    {
        $this->bannedUser = $bannedUser;
    }

    /**
     * @return User
     */
    public function getBannedUser()
    {
        return $this->bannedUser;
    }
}
