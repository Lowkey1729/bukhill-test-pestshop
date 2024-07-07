<?php

namespace Domain\Admin\V1\Actions;

use App\Models\User;
use Domain\Admin\V1\DTOs\UserListingData;
use Illuminate\Database\Eloquent\Builder;

class UserListingAction
{
    public static function execute(UserListingData $data): array
    {
        return User::query()
            ->when($data->email, function (Builder $query) use ($data) {
                $query->where('email', $data->email);
            })
            ->when($data->phone_number, function (Builder $query) use ($data) {
                $query->where('phone_number', $data->phone_number);
            })
            ->when($data->first_name, function (Builder $query) use ($data) {
                $query->where('first_name', 'like', "$data->phone_number%");
            })
            ->when($data->last_name, function (Builder $query) use ($data) {
                $query->where('last_name', 'like', "$data->last_name%");
            })
            ->when($data->address, function (Builder $query) use ($data) {
                $query->where('address', 'like', "%$data->address%");
            })
            ->when($data->is_marketing, function (Builder $query) use ($data) {
                $query->where('is_marketing', $data->is_marketing);
            })
            ->orderBy($data->sort_by, $data->direction)
            ->paginate($data->limit)
            ->toArray();
    }
}
