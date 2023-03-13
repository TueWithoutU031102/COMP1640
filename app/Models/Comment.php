<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'author_id',
        'idea_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class, 'idea_id');
    }
}
