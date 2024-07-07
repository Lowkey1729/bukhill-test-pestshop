<?php

namespace Domain\Product\V1\Actions;

use App\Models\Product;
use Domain\Product\V1\DTOs\FetchProductsData;
use Illuminate\Database\Eloquent\Builder;

class FetchProductsAction
{
    public static function execute(FetchProductsData $data): array
    {
        return Product::query()
            ->when($data->brand, function (Builder $query) use ($data) {
                $query->whereJsonContains('metadata->brand', $data->brand);
            })
            ->when($data->title, function (Builder $query) use ($data) {
                $query->where('title', 'like', "$data->title%");
            })
            ->when($data->price, function (Builder $query) use ($data) {
                $query->where('price', $data->price);
            })
            ->when($data->category, function (Builder $query) use ($data) {
                $query->whereRelation('category', 'title', $data->category);
            })
            ->orderBy((string) $data->sort_by, $data->direction)
            ->paginate($data->limit)
            ->toArray();
    }
}
