<?php

namespace Domain\Auth\V1\Actions;

use App\Models\User;
use Domain\Auth\V1\DTOs\ResetPasswordData;
use Domain\Auth\V1\Exceptions\ResetPasswordException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordAction
{
    /**
     * @throws ResetPasswordException
     */
    public static function execute(ResetPasswordData $resetPasswordData): void
    {
        $response = Password::broker('users')
            ->reset(
                $resetPasswordData->toArray(),
                function (User $user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ]);
                    $user->save();
                });

        if ($response !== Password::PASSWORD_RESET) {
            throw new ResetPasswordException('Invalid password reset request', 401);
        }
    }
}
