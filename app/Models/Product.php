<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasUuid, SoftDeletes;


    protected $fillable = [
        'metadata',
        'title',
        'uuid',
        'description',
        'category_uuid',
        'deleted_at',
        'price',
        'deleted_at'
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    protected $hidden = [
        'id'
    ];

    /**
     * @return BelongsTo<Category, Product>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_uuid', 'uuid');
    }
}
