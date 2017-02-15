<?php

namespace SPCVN\Mailers;

use SPCVN\Notifications\EmailConfirmation;
use SPCVN\Notifications\ResetPassword;
use SPCVN\User;

class UserMailer extends AbstractMailer
{
    public function sendConfirmationEmail(User $user, $token)
    {
        $user->notify(new EmailConfirmation($token));
    }

    public function sendPasswordReminder(User $user, $token)
    {
        $user->notify(new ResetPassword($token));
    }
}
