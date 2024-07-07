<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'type',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    protected $hidden = [
        'id',
    ];

    /**
     * @return HasOne<Order>
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
