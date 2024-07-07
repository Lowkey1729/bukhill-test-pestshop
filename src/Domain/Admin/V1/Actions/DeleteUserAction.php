<?php

namespace Domain\Admin\V1\Actions;

use App\Models\User;
use Domain\Admin\V1\Exceptions\DeleteUserException;
use Illuminate\Support\Facades\DB;

class DeleteUserAction
{
    /**
     * @throws DeleteUserException
     */
    public static function execute(string $uuid): void
    {
        $user = User::whereUuid($uuid)->first();

        if (! $user) {
            throw new DeleteUserException('User not found', 404);
        }

        DB::transaction(function () use ($user) {
            $user->tokens()->delete();
            $user->delete();
        });
    }
}
