<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use HasFactory;

    protected $table = 'faq_categories';

    protected $fillable = ['name'];

    // Relationship with FAQ
    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'category_id');
    }
}
