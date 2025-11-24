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
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'other_information' => 'nullable|string'
        ]);

        // Automatically attach the logged-in User ID
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $event->registrations()->create($validated);

        return redirect()->route('events.my_events')->with('success', 'Registration submitted! Status is currently pending.');
    }

    // NEW FUNCTION: Show logged-in user's events
    public function myEvents()
    {
        $registrations = Auth::user()->registrations()->with('event')->latest()->get();
        return view('users.events.my_events', compact('registrations'));
    }
    
}