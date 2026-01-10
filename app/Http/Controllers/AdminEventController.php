<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Notification;
use App\Models\Registration;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary; // Import Cloudinary Facade

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
            // UPDATED: Store on Cloudinary in the 'events' folder and get the Secure URL
            $uploadedFile = $request->file('image')->storeOnCloudinary('events');
            $data['image'] = $uploadedFile->getSecurePath();
        }

        $event = Event::create($data);

        // Send Notifications
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
            // UPDATED: Extract Public ID and delete from Cloudinary
            $publicId = $this->getPublicIdFromUrl($event->image);
            if($publicId) {
                Cloudinary::destroy($publicId);
            }
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
            // Delete old image from Cloudinary if it exists
            if ($event->image) {
                $publicId = $this->getPublicIdFromUrl($event->image);
                if($publicId) {
                    Cloudinary::destroy($publicId);
                }
            }
            // Upload new image
            $uploadedFile = $request->file('image')->storeOnCloudinary('events');
            $data['image'] = $uploadedFile->getSecurePath();
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Helper to extract Cloudinary Public ID from a URL
     * This allows us to delete the image later.
     */
    private function getPublicIdFromUrl($url)
    {
        // Example URL: https://res.cloudinary.com/demo/image/upload/v1234567/events/my_image.jpg
        // We need: events/my_image
        
        // Simple regex to grab the folder and filename (without extension)
        // Adjusts for standard Cloudinary URL structure
        if (preg_match('/(events\/[^\.]+)/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    // --- REGISTRATION MANAGEMENT (Unchanged) ---

    public function showRegistrants(Event $event)
    {
        $registrations = $event->registrations()->with('user')->latest()->get();
        return view('admin.events.registrants', compact('event', 'registrations'));
    }

    public function updateRegistration(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $request->validate([
            'name'                   => 'required|string',
            'email'                  => 'required|email',
            'phone'                  => 'required|string',
            'gender'                 => 'nullable|string',
            'age'                    => 'nullable|integer',
            'address'                => 'nullable|string',
            'payment_receipt_number' => 'nullable|string',
            'other_information'      => 'nullable|string',
            'status'                 => 'nullable|in:pending,approved,denied'
        ]);

        $registration->update($request->all());

        return redirect()->route('admin.events.registrants', $registration->event_id)
            ->with('success', 'Registration details updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,approved,denied',
        ]);

        $registration->update(['status' => $request->status]);

        return back()->with('success', "Status updated to {$request->status}");
    }

    public function bulkUpdateStatus(Request $request, Event $event)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,denied',
        ]);

        $event->registrations()->update([
            'status' => $request->status
        ]);

        return back()->with('success', "All registrations have been marked as " . ucfirst($request->status) . ".");
    }
}
