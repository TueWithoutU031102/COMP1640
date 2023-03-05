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
        'description',
        'category_id',
        'author_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "author_id");
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
