<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'title',
    ];

    protected $hidden = [
        'id',
    ];

    /**
     * @return HasMany<Order>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
