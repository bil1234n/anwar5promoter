<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class RegisterController extends Controller
{
    /**
     * Show the application registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'phoneNo' => 'required|string|max:20',
        ]);

        // Handle file uploads
        $profilePath = $request->file('profile_p') ? $request->file('profile_p')->store('profiles') : 'users.png';
        $idCardPath  = $request->file('id_card') ? $request->file('id_card')->store('documents') : null;
        $passportPath = $request->file('passport') ? $request->file('passport')->store('documents') : null;

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phoneNo' => $request->phoneNo,
            'profile_p' => $profilePath,
            'id_card' => $idCardPath,
            'passport' => $passportPath,
            // email_verified_at will naturally be NULL in the database
        ]);

        Notification::create([
            'user_id' => $user->id,
            'type'    => 'welcome',
            'message' => 'Welcome to anwar5promoter ' . $user->username,
            'is_read' => false,
        ]);

        // Log the user in immediately after registration
        Auth::login($user);

    
        // Redirect 
        return redirect('/');
    }
}
