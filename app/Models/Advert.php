<?php

namespace App\Models;

use App\Traits\BuilderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory, BuilderTrait;

    const ADVERT_MAIN = 1;
    const ADVERT_SIDEBAR_1 = 2;
    const ADVERT_SIDEBAR_2 = 3;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    private static string $imgAttr = 'image';
    private static string $imgFolder = 'advert';

    protected $fillable = [
        'title',
        'description',
        'link',
        'block',
        'status',
        'image',
    ];

    public static function getAdvert(int $block)
    {
        $key = "adverts:advert{$block}";
        if (cache()->has($key)) {
            return cache()->get($key);
        }
        $advert = self::active()->where('block', $block)->orderBy('updated_at', 'desc')->first();
        cache()->put($key, $advert, env('CACHE_INTERVAL'));
        return $advert;
    }
}
