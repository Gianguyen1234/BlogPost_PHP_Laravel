<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        // Fetch all users from the database
        $users = User::all(); // This retrieves all users

        // Pass the users to the view
        return view('admin.users.index', compact('users'));
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'usertype' => 'required|string|in:user,admin',
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Update the user details
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->usertype = $validated['usertype']; // Update user type

        // Update password if provided
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // Save the user
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
    

    
}
