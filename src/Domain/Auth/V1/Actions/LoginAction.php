<?php

namespace Domain\Auth\V1\Actions;

use App\Models\User;
use Domain\Auth\V1\DTOs\LoginData;
use Domain\Auth\V1\Exceptions\LoginException;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Support\Enums\UserType;

class LoginAction
{
    /**
     * @throws LoginException
     * @throws Exception
     */
    public static function execute(LoginData $loginData, bool $isAdmin = false): string
    {

        $user = User::query()
            ->where('email', $loginData->email)
            ->when($isAdmin, function (Builder $query) {
                $query->where('is_admin', UserType::ADMIN->value);
            })
            ->first();

        if (! $user || ! Hash::check($loginData->password, $user->password)) {
            throw new LoginException(
                message: 'The provided credentials are incorrect.',
                code: 401
            );
        }

        /** @var User $user */
        if (! $user->hasVerifiedEmail()) {
            throw new LoginException(
                message: 'Email has not been verified.',
                code: 401
            );
        }

        $accessToken = $user->createToken(
            tokenTitle: sprintf(
                '%s-%s-login-token',
                $user->email, $user->is_admin ? 'admin' : 'user'
            )
        );

        return $accessToken->getPlainTextToken();
    }
}
