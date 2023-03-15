<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone_number',
        'department_id',
        'DoB',
        'role_id',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    // public static function find($id)
    // {
    // }

    public function removeImage()
    {
        if ($this->image != null)
            return unlink(public_path($this->image));
        else return;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isUser(): bool
    {
        if ($this->role_id != null)
            return true;
        return false;
    }

    public function isAdmin(): bool
    {
        if ($this->role_id == '1')
            return true;
        return false;
    }

    public function isStaff(): bool
    {
        if ($this->role_id == '2')
            return true;
        return false;
    }

    public function isQAC(): bool
    {
        if ($this->role_id == '3')
            return true;
        return false;
    }

    public function isQAM(): bool
    {
        if ($this->role_id == '4')
            return true;
        return false;
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class, 'author_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'author_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'author_id');
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
