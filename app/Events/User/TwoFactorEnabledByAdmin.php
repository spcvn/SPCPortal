<?php

namespace SPCVN\Events\User;

use SPCVN\User;

class TwoFactorEnabledByAdmin
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
