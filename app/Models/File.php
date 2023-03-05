<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'idea_id'
    ];
    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }


}
