<?php

namespace App\Models;

use App\Traits\BuilderTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string content
 * @property int post_id
 * @property int user_id
 * @property Post post
 * @property User user
 * @property int status
 * @property string created_at
 */
class Comment extends Model
{
    use HasFactory, BuilderTrait;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_MODERATION = 2;

    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'status',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeReceive(Builder $query)
    {
        return $query->with('user')->orderBy('created_at', 'desc')->paginate(env('PAGINATION_COUNT'));
    }
}
