<?php

namespace Domain\Auth\V1\Actions;

use App\Models\User;
use Domain\Auth\V1\DTOs\RegisterData;
use Support\Enums\UserType;

class RegisterAction
{
    /**
     * @throws \Exception
     */
    public static function execute(RegisterData $registerData, bool $isAdmin = false): User
    {
        $registerData = $registerData->toArray();
        $registerData['is_admin'] = $isAdmin ? UserType::ADMIN->value : UserType::USER->value;

        /** @var User $user */
        $user = User::query()->create($registerData);

        $accessToken = $user->createToken(
            tokenTitle: sprintf(
                '%s-%s-register-token',
                $user->email, $user->is_admin ? 'admin' : 'user'
            )
        );

        $user['token'] = $accessToken->getPlainTextToken();

        return $user;
    }
}
