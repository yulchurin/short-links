<?php

namespace Mactape\ShortLinks;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;
use RuntimeException;

class UrlShortener
{
    public function generate(string $url, ?CarbonInterface $expires = null): string
    {
        $url = trim($url);
        $hash = $this->hash($url);

        ShortLinkModel::query()->firstOrCreate([
            'hash' => $hash,
        ], [
            'url' => $url,
            'expires_at' => $expires ?? CarbonImmutable::now()->addHours(Config::get('short-links.expiration')),
        ]);

        return $this->short($hash);
    }

    /**
     * @throws RuntimeException
     */
    public function open(string $hash): Application|Redirector|RedirectResponse|ApplicationContract|JsonResponse
    {
        /** @var ShortLinkModel|null $link */
        $link = ShortLinkModel::query()->where('hash', $hash)->first();

        if ($link === null) {
            throw new RuntimeException('No link found with hash presented');
        }

        if ($link->expires_at < CarbonImmutable::now()) {
            throw new RuntimeException('Link expired');
        }

        if (Config::get('short-links.allow_reuse_links') === false && $link->used === true) {
            throw new RuntimeException('The link you provided is stale');
        }

        $link->used = true;
        $link->save();

        return redirect($link->url);
    }

    private function short(string $hash): string
    {
        return rtrim(Config::get('short-links.domain'), '/')."/s/$hash";
    }

    private function hash(string $url): string
    {
        $binary = hash('xxh3', $url, true);
        $int = unpack('J', $binary)[1];

        return $this->toBase62($int);
    }

    private function toBase62(int $number): string
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($chars);
        $result = '';

        do {
            $result = $chars[$number % $base] . $result;
            $number = intdiv($number, $base);
        } while ($number > 0);

        return $result;
    }
}
