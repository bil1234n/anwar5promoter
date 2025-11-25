<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile view.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        // 'auth()->user()' gets the currently authenticated user
        return view('profile', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for editing the specified user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        return view('edituser', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the specified user's profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            // Rule::unique ignores the current user's email
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phoneNo' => 'required|string|max:20',
            'password' => 'nullable|string|confirmed|min:6', // Optional new password
            'profile_p' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional file upload
        ]);

        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->phoneNo = $validatedData['phoneNo'];

        // Handle password update if provided
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Handle profile picture update
        if ($request->hasFile('profile_p')) {
            // Delete old profile picture if it's not the default
            if ($user->profile_p && $user->profile_p !== 'users.png') {
                \Illuminate\Support\Facades\Storage::disk('cloudinary')->delete($user->profile_p);
            }
            $user->profile_p = $request->file('profile_p')->store('profiles');
        }

        $user->save();

        return redirect()->route('profile')->with('status', 'Profile updated successfully!');
    }

    /**
     * The ID card and Passport fields are not included in the standard update
     * for simplicity, as they are usually set once during registration.
     * If you need to update them, you would add similar file handling logic here.
     */
}
