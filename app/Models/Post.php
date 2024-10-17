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
        'content',
        'banner_image',
        'title_image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()  // You can name this method anything; 'author' is more descriptive
    {
        return $this->belongsTo(User::class, 'created_by');  // 'created_by' is the foreign key
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
}
