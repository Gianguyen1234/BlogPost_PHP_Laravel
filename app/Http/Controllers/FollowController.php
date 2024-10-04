<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class FollowController extends Controller
{

    public function follow($slug, $id)
    {
        $author = User::findOrFail($id);
        $user = Auth::user();
    
        // Attach the author if not already followed
        if (!$user->following()->where('followed_id', $author->id)->exists()) {
            $user->following()->attach($author->id);
        }
    
        return response()->json(['success' => true, 'message' => 'You are now following ' . $author->name]);
    }
    
    public function unfollow($slug, $id)
    {
        $author = User::findOrFail($id);
        $user = Auth::user();
    
        // Detach the author if already followed
        if ($user->following()->where('followed_id', $author->id)->exists()) {
            $user->following()->detach($author->id);
        }
    
        return response()->json(['success' => true, 'message' => 'You have unfollowed ' . $author->name]);
    }
    

}
