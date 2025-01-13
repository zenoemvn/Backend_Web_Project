<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'faqs';

    // Allow mass assignment for these fields
    protected $fillable = [
        'category_id',
        'question',
        'answer',
    ];

    // Relationship with FAQCategory
    public function category()
    {
        return $this->belongsTo(FAQCategory::class, 'category_id');
    }
}
