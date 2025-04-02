<?php

namespace Mactape\ShortLinks;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Support\Facades\Config;

/**
 * @property int $id
 * @property string $hash
 * @property string $url
 * @property bool $used
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $expires_at
 *
 * @method static Builder|ShortLinkModel newModelQuery()
 * @method static Builder|ShortLinkModel newQuery()
 * @method static Builder|ShortLinkModel query()
 * @method static Builder|ShortLinkModel whereCreatedAt($value)
 * @method static Builder|ShortLinkModel whereExpiresAt($value)
 * @method static Builder|ShortLinkModel whereHash($value)
 * @method static Builder|ShortLinkModel whereId($value)
 * @method static Builder|ShortLinkModel whereUrl($value)
 * @method static Builder|ShortLinkModel whereUsed($value)
 */
class ShortLinkModel extends Model
{
    use Prunable;

    protected $table = 'short_links';

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
            ->when(Config::get('short-links.allow_reuse_links') === false, function (Builder $query) {
                $query->orWhere('used', true);
            });
    }
}
