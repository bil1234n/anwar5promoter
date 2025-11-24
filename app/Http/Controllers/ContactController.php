<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // 1. Show User Form
    public function showForm()
    {
        return view('users.contact');
    }

    // 2. Submit Message
    public function submitForm(Request $request)
    {
        // STRICT CHECK: If not logged in, redirect to login immediately
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to send a message.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'company'   => 'required|string|max:255',
            'subject'   => 'required|string|max:255',
            'message'   => 'required|string',
        ]);

        // Attach User ID
        $validated['user_id'] = Auth::id();

        ContactMessage::create($validated);

        return back()->with('success', 'Message sent successfully!');
    }

    // 3. User: Check History (Session Based)
    public function checkMessages()
    {
        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your messages.');
        }

        // Get messages strictly for the logged-in user
        $messages = ContactMessage::where('user_id', Auth::id())
                                  ->latest()
                                  ->get();

        return view('users.history', compact('messages'));
    }

    // 4. Admin: Index
    public function adminIndex()
    {
        $messages = ContactMessage::with('user')->latest()->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }

    // 5. Admin: Reply
    public function adminReply(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string'
        ]);

        $contact = ContactMessage::findOrFail($id);

        $contact->update([
            'admin_reply' => $request->reply_message,
            'replied_at' => now(),
        ]);

        sendNotification(
            $contact->user_id,
            'message_reply',
            "Your message has been replied by admin: {$request->reply_message}"
        );

        return back()->with('success', 'Reply saved.');
    }
}
