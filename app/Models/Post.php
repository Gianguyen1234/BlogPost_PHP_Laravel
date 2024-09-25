<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'youtube_iframe',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'status',
        'created_by',
        'content'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
