<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function create()
    {
        return view('userprofile.create'); // Create a view for creating a new profile
    }
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048', // max size 2MB
            'github_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        // Check if the authenticated user already has a profile
        $profile = Auth::user()->profile;

        if ($profile) {
            // Update the existing profile
            $profile->update($validated);
        } else {
            // Create a new profile for the authenticated user
            $profile = Auth::user()->profile()->create($validated);
        }

        // Handle file upload for profile picture
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($profile->profile_picture) {
                Storage::disk('public')->delete($profile->profile_picture);
            }

            // Store the new profile picture in the 'public/profile_pictures' directory
            $profile->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
            $profile->save(); // Save the profile with the new profile picture path
        }

        return redirect()->route('userprofile.show')->with('success', 'Profile saved successfully!');
    }


    /**
     * Show the user's profile.
     */
    public function show()
    {
        // Retrieve the profile for the logged-in user
        $profile = Auth::user()->profile;

        // Check if profile exists
        if (!$profile) {
            return redirect()->route('userprofile.edit')->with('success', 'Please create a profile first.');
        }

        return view('userprofile.show', compact('profile'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $profile = Auth::user()->profile;

        // Check if profile exists
        if (!$profile) {
            return redirect()->route('userprofile.create')->with('success', 'Please create a profile first.');
        }

        return view('userprofile.edit', compact('profile'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048', // max size 2MB
            'github_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        // Get the authenticated user's profile
        $profile = Auth::user()->profile;

        // If a profile picture is uploaded, handle file upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($profile->profile_picture) {
                Storage::delete($profile->profile_picture);
            }

            // Store new profile picture and save the path
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures');
        }

        // Update the profile with the validated data
        $profile->update($validated);

        return redirect()->route('userprofile.show')->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's profile.
     */
    public function destroy()
    {
        $profile = Auth::user()->profile;

        // Delete the profile picture if it exists
        if ($profile->profile_picture) {
            Storage::delete($profile->profile_picture);
        }

        // Delete the profile
        $profile->delete();

        return redirect()->route('userprofile.show')->with('success', 'Profile deleted successfully!');
    }
}
