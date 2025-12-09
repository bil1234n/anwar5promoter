<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            if(Auth::user()->status !== 'approve') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is not approved yet.']);
            }

            Notification::create([
                'user_id' => Auth::id(),
                'type'    => 'welcome',
                'message' => 'Welcome back ' . Auth::user()->username . ' to anwar5promoter',
                'is_read' => false,
            ]);

            // --- NEW CODE STARTS HERE ---
            // Check if the intended URL is the notification fetcher
            $intendedUrl = session()->get('url.intended');
            
            if ($intendedUrl && str_contains($intendedUrl, '/notifications/fetch')) {
                // If it is, remove it from the session so we don't redirect there
                session()->forget('url.intended');
            }
            // --- NEW CODE ENDS HERE ---

            // Redirect based on user's role
            $role = Auth::user()->role;
            switch ($role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'delivery_boy':
                    return redirect()->intended('/delivery/dashboard');
                case 'user':
                    return redirect()->intended('/user/home');
                default:
                    return redirect()->intended('/');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
