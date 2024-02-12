<?php

namespace App\Models;

use App\Traits\BuilderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string question
 * @property string answer
 * @property string avatar
 * @property int is_admin
 * @property int status
 * @property string created_at
 * @property Comment[] comments
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BuilderTrait;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    private static string $imgAttr = 'avatar';
    private static string $imgFolder = 'avatar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'question',
        'answer',
        'avatar',
        'is_admin',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public static function getAttributesNames(): array
    {
        return [
            'name' => 'Name',
            'email' => 'E-mail',
            'password' => 'Password',
            'password_confirmation' => 'Password confirmation',
            'question' => 'Question',
            'answer' => 'Answer',
            'avatar' => 'Avatar',
            'is_admin' => 'Role',
            'status' => 'Status',
        ];
    }

    public function getImage(): string
    {
        if ($this->avatar) {
            return asset("uploads/{$this->avatar}");
        }
        return asset('assets/admin/img/default-user.png');
    }
}
