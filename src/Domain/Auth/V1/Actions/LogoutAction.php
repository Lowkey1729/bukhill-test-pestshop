<?php

namespace Domain\Auth\V1\Actions;

use App\Models\User;

class LogoutAction
{
    public static function execute(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
