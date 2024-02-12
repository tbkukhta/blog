<?php

namespace App\Models;

use App\Traits\BuilderTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string slug
 * @property string description
 * @property string content
 * @property string thumbnail
 * @property int category_id
 * @property int views
 * @property int status
 * @property string created_at
 * @property string updated_at
 * @property Category category
 * @property Tag[] tags
 * @property Comment[] comments
 */
class Post extends Model
{
    use HasFactory, BuilderTrait, Sluggable;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    private static string $imgAttr = 'thumbnail';
    private static string $imgFolder = 'images';

    protected $fillable = [
        'title',
        'description',
        'content',
        'category_id',
        'thumbnail',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
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

    public function getImage()
    {
        if ($this->thumbnail) {
            return asset("uploads/{$this->thumbnail}");
        }
        return asset('assets/site/images/no-image.png');
    }

    public static function setPopularPosts($cache = false)
    {
        if ($cache && cache()->has('posts')) {
            return cache()->get('posts');
        }
        $posts = self::orderBy('views', 'desc')->limit(env('POPULAR_COUNT'))->get();
        cache()->put('posts', $posts, env('CACHE_INTERVAL'));
        return $posts;
    }
}
