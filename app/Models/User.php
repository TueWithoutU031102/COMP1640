<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
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

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
