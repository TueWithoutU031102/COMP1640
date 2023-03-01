<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;
    protected $table ='ideas';

    protected $fillable = [
        'title',
        'content',
        'author_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
