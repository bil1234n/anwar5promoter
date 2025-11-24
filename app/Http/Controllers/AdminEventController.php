<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;          
use App\Models\Notification;   
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('registrations')->orderBy('event_date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event = Event::create($data);

        $users = User::all();
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type'    => 'events', 
                'message' => "New event posted: {$event->title}",
                'is_read' => false,
            ]);
        }

        return redirect()->back()->with('success', 'Event created and notifications sent!');
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();
        return back()->with('success', 'Event deleted.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    // --- REGISTRATION MANAGEMENT ---

    public function showRegistrants(Event $event)
    {
        // Load registrations with the associated user info
        $registrations = $event->registrations()->with('user')->latest()->get();
        return view('admin.events.registrants', compact('event', 'registrations'));
    }

    public function editRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        return view('admin.registrations.edit', compact('registration'));
    }

    public function updateRegistration(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'other_information' => 'nullable|string',
            'status' => 'nullable|in:pending,approved,denied'
        ]);

        $registration->update($request->all());

        return redirect()->route('admin.events.registrants', $registration->event_id)
            ->with('success', 'Registration updated.');
    }

    public function updateStatus(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,approved,denied',
        ]);

        $registration->update(['status' => $request->status]);

        // Optional: Send Notification to user here

        return back()->with('success', "Status updated to {$request->status}");
    }

    public function bulkUpdateStatus(Request $request, Event $event)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,denied',
        ]);

        // Mass update all registrations belonging to this event
        $event->registrations()->update([
            'status' => $request->status
        ]);

        return back()->with('success', "All registrations have been marked as " . ucfirst($request->status) . ".");
    }
}