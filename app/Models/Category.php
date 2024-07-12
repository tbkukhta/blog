<?php

namespace App\Models;

use App\Traits\BuilderTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, BuilderTrait, Sluggable;

    protected $fillable = ['title'];

    public function posts()
    {
        return $this->hasMany(Post::class);
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

    public static function setPopularCategories($cache = false)
    {
        if ($cache && cache()->has('categories:popular')) {
            return cache()->get('categories:popular');
        }
        $categories = self::orderBy('posts_count', 'desc')->withCount('posts')->limit(env('POPULAR_COUNT'))->get();
        cache()->put('categories:popular', $categories, env('CACHE_INTERVAL'));
        return $categories;
    }
}
