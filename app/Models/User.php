<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\File;
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
        if (File::exists(public_path($this->image))) return File::delete(public_path($this->image));
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function isUser(): bool
    {
        return $this->role_id != null;
    }

    public function isAdmin(): bool
    {
        return $this->role_id == 1;
    }

    public function isStaff(): bool
    {
        return $this->role_id == 2;
    }

    public function isQAC(): bool
    {
        return $this->role_id == 3;
    }

    public function isQAM(): bool
    {
        return $this->role_id == 4;
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'department_id' => $this->department_id,
            'DoB' => $this->DoB,
            'role_id' => $this->role->id,
            'image' => $this->image,
        ];
    }
}
