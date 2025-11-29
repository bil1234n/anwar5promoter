<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Notification;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // Log out current Laravel user
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        // Redirect to Google and force account selection
        return Socialite::driver('google')
            ->stateless()
            ->with(['prompt' => 'select_account']) // forces Google to show account chooser
            ->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Find the user or create a new one based on the email.
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'username' => $googleUser->getName(),
                'password' => bcrypt(uniqid()),
                'profile_p' => 'users.png',
                'role' => 'user',
                'status' => 'approve'
            ]
        );

        // Explicitly set the email_verified_at for both new and existing users
        // This marks the user as verified because Google has already validated the email.
        $user->email_verified_at = now();
        $user->save();

        if ($user->wasRecentlyCreated) {
            // New User Registration Message
            Notification::create([
                'user_id' => $user->id,
                'type'    => 'welcome',
                'message' => 'Welcome to anwar5promoter ' . $user->username,
                'is_read' => false,
            ]);
        } else {
            // Existing User Login Message
            Notification::create([
                'user_id' => $user->id,
                'type'    => 'welcome',
                'message' => 'Welcome back ' . $user->username . ' to anwar5promoter',
                'is_read' => false,
            ]);
        }
        
        // Log the user in
        Auth::login($user, true);

        
        // Redirect based on user's role
        $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'user':
                return redirect()->intended('/user/home');
            default:
                return redirect()->intended('/');
        }
    }
}
