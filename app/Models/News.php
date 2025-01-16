<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'publication_date',
    ];
    protected $casts = [
        'publication_date' => 'date',
    ];

    public function comments()
{
    return $this->hasMany(Comment::class);
}

}
