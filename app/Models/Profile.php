<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bio', 'profile_picture', 'github_link', 'twitter_link','linkedin_link'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
