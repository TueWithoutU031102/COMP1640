<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'author_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }
}
