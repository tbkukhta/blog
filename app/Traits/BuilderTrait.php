<?php

namespace App\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin Builder
 */
trait BuilderTrait
{
    public function getDate($time = false)
    {
        return $this->created_at->format('d F Y' . ($time ? ', H:i' : ''));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->active();
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeSearch(Builder $query, array|string $params, string $value)
    {
        if (is_array($params)) {
            foreach ($params as $param) {
                if (in_array($param, ['category', 'tags', 'post', 'user'])) {
                    $query = $query->orWhereHas($param, function ($query) use ($param, $value) {
                        $query->where($param === 'user' ? 'name' : 'title', 'LIKE', "%{$value}%");
                    });
                } else if (in_array($param, ['role', 'status', 'block'])) {
                    $attr = [];
                    $pattern = '/^.*?' . preg_quote($value) . '.*?$/i';
                    if ($param === 'role') {
                        if (preg_match($pattern, 'User')) $attr[] = 0;
                        else if (preg_match($pattern, 'Admin')) $attr[] = 1;
                    } else if ($param === 'status') {
                        if (preg_match($pattern, 'Disabled')) $attr[] = 0;
                        if (preg_match($pattern, 'Active')) $attr[] = 1;
                        if (preg_match($pattern, 'Moderation')) $attr[] = 2;
                    } else if ($param === 'block') {
                        if (preg_match($pattern, 'Main page')) $attr[] = 1;
                        if (preg_match($pattern, 'Sidebar 1st')) $attr[] = 2;
                        if (preg_match($pattern, 'Sidebar 2nd')) $attr[] = 3;
                    }
                    if (!empty($attr)) $query = $query->orWhereIn($param, $attr);
                } else {
                    $query = $query->orWhere($param, 'LIKE', "%{$value}%");
                }
            }
            return $query;
        }
        return $query->where($params, 'LIKE', "%{$value}%");
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile(self::$imgAttr)) {
            self::deleteImage($image);
            $folder = date('Y-m-d');
            return $request->file(self::$imgAttr)->store(self::$imgFolder . '/' . $folder);
        }

        if ($request->deleted) {
            self::deleteImage($image);
            return null;
        }

        return false;
    }

    public static function deleteImage($image = null): void
    {
        if ($image) {
            Storage::delete($image);
            if (empty(Storage::files($directory = substr($image, 0, 17)))) {
                Storage::deleteDirectory($directory);
            }
        }
    }
}
