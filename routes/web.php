<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- Auth Controller Imports ---
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleController;

// --- Controller Imports ---
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\ChapaController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController; 
use App\Models\Notification;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\AdminController;

// Authentication
Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class,'register']);
Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LoginController::class,'logout'])->name('logout');

// Password Reset
Route::get('/forgot-password', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class,'reset'])->name('password.update');

// Email Verification
Route::get('/email/verify', function(){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function(\Illuminate\Foundation\Auth\EmailVerificationRequest $request){
    $request->fulfill();
    return redirect('/');
})->middleware(['auth','signed'])->name('verification.verify');

Route::post('/email/resend', function(Request $request){
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success','Verification link sent!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');

// Google Login
Route::get('auth/google', [GoogleController::class,'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class,'handleGoogleCallback']);

// ------------------ GOOGLE LOGIN ------------------
Route::get('auth/google', [GoogleController::class,'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class,'handleGoogleCallback']);

// ------------------ PUBLIC PAGES ------------------
Route::view('/about', 'users.about');
Route::view('/blog', 'blogs.index')->name('blogs.index');
Route::view('/contact', 'users.contact');
Route::get('/socialMedia', [SocialMediaController::class, 'socialMediaPage'])->name('user.socialMedia');
Route::view('/services', 'users.services');
Route::view('/services_1', 'users.services.services_1');
Route::view('/services_2', 'users.services.services_2');
Route::view('/services_3', 'users.services.services_3');
Route::view('/services_4', 'users.services.services_4');
Route::view('/services_5', 'users.services.services_5');
Route::view('/services_6', 'users.services.services_6');
Route::view('/services_7', 'users.services.services_7');
Route::view('/services_8', 'users.services.services_8');
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::get('/blog', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/event', [PublicEventController::class, 'index'])->name('event.index');

// ------------------ AUTHENTICATED USER ROUTES ------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/', function() {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $role = auth()->user()->role;
        switch ($role) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'user':
                return redirect('/');
            default:
                return redirect('/login');
        }
    });

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('/my-messages', [ContactController::class, 'checkMessages'])->name('contact.history');

    // payment with chapa
    Route::get('/payment', function () { return view('payment'); })->name('donate.form');
    // Route::post('/process-payment', [ChapaController::class, 'processPayment'])->name('donate.pay');
    // Route::get('/payment-callback', [ChapaController::class, 'paymentCallback'])->name('donate.callback');

    // payment with stripe
    Route::post('/donate/pay', [StripeController::class, 'processPayment'])->name('donate.pay');
    Route::get('/donate/success', [StripeController::class, 'paymentSuccess'])->name('stripe.success');
    Route::get('/donate/cancel', [StripeController::class, 'paymentCancel'])->name('stripe.cancel');

    // Fetch unread notifications (AJAX)
    Route::get('/notifications/fetch', function () { return \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false) ->latest() ->get();});
    // Mark as read
    Route::post('/notifications/read/{id}', function ($id) { 
        $note = \App\Models\Notification::where('user_id', Auth::id())->where('id', $id)->first();
        
        if ($note) { 
            $note->update(['is_read' => true]); 
        }
        
        return response()->json(['success' => true]);
    });
    
});


// USER DASHBOARD
Route::middleware(['auth','role:user'])->group(function() {
    Route::view('/user/home', 'users.index')->name('user.home');
    Route::get('/events/{event}/register', [PublicEventController::class, 'showRegister'])->name('events.register');
    Route::post('/events/{event}/register', [PublicEventController::class, 'storeRegister'])->name('events.store');
    Route::get('/my-events', [PublicEventController::class, 'myEvents'])->name('events.my_events');
});

Route::view('/', 'users.index');

// ADMIN DASHBOARD
Route::middleware(['auth','role:admin'])->group(function() {
    Route::view('/admin/dashboard', 'admin.index')->name('admin.dashboard');
    // // ChapaController donation history
    // Route::get('/admin/donations', [ChapaController::class, 'adminDonations'])->name('admin.donations');
    Route::get('/admin/donations', [StripeController::class, 'adminDonations'])->name('admin.donations');
    Route::get('/admin/donations', [AdminController::class, 'donations'])->name('admin.donations');

    // CONTACT
    Route::get('/messages', [ContactController::class, 'adminIndex'])->name('admin.messages');
    Route::post('/messages/{id}/reply', [ContactController::class, 'adminReply'])->name('admin.reply');
    
    // BLOG
    
    Route::get('/blogs', [BlogController::class, 'adminIndex'])->name('admin.blogs.index');

  Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    
    // Changed to PUT to match the @method('PUT') in the form
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.delete');
    
    // EVENTS
    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::post('/events/create', [AdminEventController::class, 'store'])->name('admin.events.create');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.delete');
    Route::patch('/events/{event}/registrations/bulk-status',[App\Http\Controllers\AdminEventController::class, 'bulkUpdateStatus'])->name('admin.events.bulk_status');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
    
    // Registrants
    Route::get('/events/{event}/registrants', [AdminEventController::class, 'showRegistrants']) ->name('admin.events.registrants');
    Route::patch('/registrations/{id}/status', [AdminEventController::class, 'updateStatus'])->name('admin.registrations.status');
    Route::get('/registrations/{id}/edit', [AdminEventController::class, 'editRegistration'])->name('admin.registrations.edit');
    Route::put('/registrations/{id}', [AdminEventController::class, 'updateRegistration'])->name('admin.registrations.update');

    // USERS
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');

});
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function () {
    // Clear all caches
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    
    return 'Cache Cleared! Try refreshing your site now.';
});
