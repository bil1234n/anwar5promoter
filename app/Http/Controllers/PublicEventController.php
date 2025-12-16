<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicEventController extends Controller
{
    public function index()
    {
        // Show upcoming events first
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('users.events.index', compact('events'));
    }

    public function showRegister(Event $event)
    {
        // Prevent double registration (Optional logic)
        $existingRegistration = $event->registrations()->where('user_id', Auth::id())->exists();
        if($existingRegistration) {
            return redirect()->route('events.my_events')->with('error', 'You are already registered for this event.');
        }

        return view('users.events.register', compact('event'));
    }

    public function storeRegister(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name'              => 'required|string',
            'email'             => 'required|email',
            'phone'             => 'required|string',
            'gender'            => 'required|string|in:Male,Female',
            'age'               => 'required|integer|min:1',
            'address'           => 'required|string',
            'other_information' => 'nullable|string',
            // Validation Logic: 
            // If payment_method_type is 'photo', receipt_photo is required.
            // If payment_method_type is 'number', receipt_number is required.
            'payment_method_type' => 'required|in:photo,number',
            'receipt_photo'       => 'required_if:payment_method_type,photo|image|mimes:jpeg,png,jpg|max:2048',
            'receipt_number'      => 'required_if:payment_method_type,number|nullable|string',
        ]);

        // Basic Data
        $data = [
            'user_id'           => Auth::id(),
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'phone'             => $validated['phone'],
            'gender'            => $validated['gender'],
            'age'               => $validated['age'],
            'address'           => $validated['address'],
            'other_information' => $validated['other_information'],
            'status'            => 'pending',
        ];

        // Handle Payment Logic
        if ($request->payment_method_type === 'photo' && $request->hasFile('receipt_photo')) {
            // Upload the file to storage/app/public/receipts
            $path = $request->file('receipt_photo')->store('receipts', 'public');
            $data['payment_receipt_path'] = $path;
            $data['payment_receipt_number'] = null; // Clear number if they chose photo
        } elseif ($request->payment_method_type === 'number') {
            $data['payment_receipt_number'] = $validated['receipt_number'];
            $data['payment_receipt_path'] = null; // Clear path if they chose number
        }

        // Create Registration
        $event->registrations()->create($data);

        return redirect()->route('events.my_events')->with('success', 'Registration submitted! Status is currently pending.');
    }

    // NEW FUNCTION: Show logged-in user's events
    public function myEvents()
    {
        $registrations = Auth::user()->registrations()->with('event')->latest()->get();
        return view('users.events.my_events', compact('registrations'));
    }
    
}
