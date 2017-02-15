<?php

namespace SPCVN\Http\Requests\User;

use SPCVN\Http\Requests\Request;
use SPCVN\User;

class UpdateProfileLoginDetailsRequest extends UpdateLoginDetailsRequest
{
    /**
     * Get authenticated user.
     *
     * @return mixed
     */
    protected function getUserForUpdate()
    {
        return \Auth::user();
    }
}
