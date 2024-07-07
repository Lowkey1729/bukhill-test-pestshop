<?php

namespace Domain\Auth\V1\Actions;

use App\Models\User;
use Domain\Auth\V1\Exceptions\ForgotPasswordException;
use Illuminate\Support\Facades\Password;

class ForgotPasswordAction
{
    /**
     * @throws ForgotPasswordException
     */
    public static function execute(string $email): string
    {
        $user = User::query()
            ->where('email', $email)
            ->first();

        if (! $user) {
            throw new ForgotPasswordException('Invalid user email', 404);
        }

        return Password::broker('users')->createToken($user);
    }
}
