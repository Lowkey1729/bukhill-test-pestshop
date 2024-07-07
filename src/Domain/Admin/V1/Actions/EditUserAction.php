<?php

namespace Domain\Admin\V1\Actions;

use App\Models\User;
use Domain\Admin\V1\DTOs\EditUserData;
use Domain\Admin\V1\Exceptions\EditUserException;

class EditUserAction
{
    /**
     * @throws EditUserException
     */
    public static function execute(EditUserData $editUserData, string $uuid): User
    {
        $user = User::whereUuid($uuid)->first();

        if (! $user) {
            throw new EditUserException('User not found', 404);
        }

        /** @var User $user */
        $user->update(array_filter($editUserData->toArray(), fn ($item) => ! is_null($item)));

        return $user;
    }
}
