<?php

namespace Domain\Admin\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Domain\Admin\V1\Exceptions\DeleteUserException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Support\Responses\V1\SuccessResponse;

class DeleteUserController extends Controller
{
    /**
     * @throws DeleteUserException
     */
    public function __invoke(string $uuid): Responsable
    {
        $user = User::whereUuid($uuid)->first();

        if (! $user) {
            throw new DeleteUserException('User not found');
        }

        DB::transaction(function () use ($user) {
            $user->currentAccessToken()->delete();
            $user->delete();
        });

        return new SuccessResponse;
    }
}
