<?php

namespace Mactape\ShortLinks;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

/**
 * @property int $id
 * @property string $hash
 * @property string $url
 * @property bool $used
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $expires_at
 *
 * @method static Builder|ShortLink newModelQuery()
 * @method static Builder|ShortLink newQuery()
 * @method static Builder|ShortLink query()
 * @method static Builder|ShortLink whereCreatedAt($value)
 * @method static Builder|ShortLink whereExpiresAt($value)
 * @method static Builder|ShortLink whereHash($value)
 * @method static Builder|ShortLink whereId($value)
 * @method static Builder|ShortLink whereUrl($value)
 * @method static Builder|ShortLink whereUsed($value)
 */
class ShortLinkModel extends Model
{
    use Prunable;

    public const mixed UPDATED_AT = null;

    protected $fillable = [
        'hash',
        'url',
        'used',
        'expires_at',
    ];

    protected $casts = [
        'used' => 'boolean',
        'expires_at' => 'immutable_datetime',
    ];

    public function prunable(): Builder
    {
        return static::query()
            ->where('expires_at', '<=', now())
            ->orWhere('used', true);
    }
}
