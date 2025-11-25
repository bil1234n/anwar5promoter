<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

        // Log the user in
        Auth::login($user, true);

        return redirect('/');
    }
}
