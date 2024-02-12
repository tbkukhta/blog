<?php

namespace App\Models;

use App\Traits\BuilderTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, BuilderTrait, Sluggable;

    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public static function setPopularTags($cache = false)
    {
        if ($cache && cache()->has('tags')) {
            return cache()->get('tags');
        }
        $tags = self::orderBy('posts_count', 'desc')->withCount('posts')->limit(env('POPULAR_COUNT'))->get();
        cache()->put('tags', $tags, env('CACHE_INTERVAL'));
        return $tags;
    }
}
