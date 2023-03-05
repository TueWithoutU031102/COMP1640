<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Submission extends Model
{
    use HasFactory;
    protected $table ='submissions';

    protected $fillable = [
        'title',
        'description',
        'startDate',
        'dueDate',
        'author_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

}
