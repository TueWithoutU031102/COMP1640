<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Idea extends Model
{
    use HasFactory;

    protected $table = 'ideas';

    protected $fillable = [
        'title',
        'description',
        'views',
        'isAnonymous',
        'submission_id',
        'category_id',
        'author_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "author_id");
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('author_id', $user->id);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function dislikedBy(User $user)
    {
        return $this->dislikes->contains('author_id', $user->id);
    }


    public function files()
    {
        return $this->hasMany(File::class);
    }
}
