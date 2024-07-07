<?php

namespace Domain\User\V1\Actions;

use App\Models\Order;
use App\Models\User;
use Domain\User\V1\DTOs\ViewOrderData;
use Domain\User\V1\Exceptions\ViewOrderException;

class ViewOrderAction
{
    /**
     * @throws ViewOrderException
     */
    public static function execute(ViewOrderData $data, User $user): array
    {
        $orderQueryBuilder = Order::query()
//            ->where('user_id', $user->id)
            ->with(['payment', 'orderStatus']);

        if ($orderQueryBuilder->count() == 0) {
            throw new ViewOrderException('You have no orders', 404);
        }

        return $orderQueryBuilder
            ->orderBy((string) $data->sort_by, $data->direction)
            ->paginate($data->limit)
            ->toArray();
    }
}
