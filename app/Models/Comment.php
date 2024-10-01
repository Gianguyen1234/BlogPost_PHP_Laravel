<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['author_name', 'content', 'post_id', 'parent_id','upvotes'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    // Define self-referencing relationship for replies
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Get parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
