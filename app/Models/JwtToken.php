<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $tokenable_type
 * @property int $tokenable_id
 * @property string $token
 * @property string $name
 * @property array|null $abilities
 * @property string $expires_at
 * @property string|null $last_used_at
 * @property string|null $refreshed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read  User $tokenable
 * @method static Builder|JwtToken newModelQuery()
 * @method static Builder|JwtToken newQuery()
 * @method static Builder|JwtToken query()
 * @method static Builder|JwtToken whereAbilities($value)
 * @method static Builder|JwtToken whereCreatedAt($value)
 * @method static Builder|JwtToken whereExpiresAt($value)
 * @method static Builder|JwtToken whereId($value)
 * @method static Builder|JwtToken whereLastUsedAt($value)
 * @method static Builder|JwtToken whereName($value)
 * @method static Builder|JwtToken whereRefreshedAt($value)
 * @method static Builder|JwtToken whereToken($value)
 * @method static Builder|JwtToken whereTokenableId($value)
 * @method static Builder|JwtToken whereTokenableType($value)
 * @method static Builder|JwtToken whereUpdatedAt($value)
 * @mixin JwtToken
 */
class JwtToken extends Model
{
    protected $fillable = [
        'unique_id',
        'name',
        'abilities',
        'expires_at',
        'last_used_at',
        'refreshed_at',
    ];

    protected $casts = [
        'abilities' => 'json',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'abilities',
    ];

    /**
     * Get the tokenable model that the access token belongs to.
     *
     * @return MorphTo<Model, JwtToken>
     */
    public function tokenable(): MorphTo
    {
        return $this->morphTo('tokenable');
    }

    public static function findToken(string $token): ?object
    {
        return static::where('unique_id', hash('sha256', $token))->first();
    }

    /**
     * Determine if the token has a given ability.
     */
    public function can(string $ability): bool
    {
        if (is_null($this->abilities)) {
            return true;
        }

        return in_array('*', $this->abilities) ||
            array_key_exists($ability, array_flip($this->abilities));
    }

    /**
     * Determine if the token is missing a given ability.
     */
    public function cant(string $ability): bool
    {
        return ! $this->can($ability);
    }
}
