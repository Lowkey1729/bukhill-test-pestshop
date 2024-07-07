<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'amount',
        'user_id',
        'address',
        'delivery_fee',
        'order_status_id',
        'payment_id',
        'products',
        'shipped_at',
    ];

    protected $casts = [
        'products' => 'array',
        'address' => 'array',
    ];

    protected $hidden = [
        'id',
        'payment_id',
        'order_status_id',
        'user_id',
    ];

    /**
     * @return BelongsTo<User, Order>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<OrderStatus, Order>
     */
    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * @return BelongsTo<Payment, Order>
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
