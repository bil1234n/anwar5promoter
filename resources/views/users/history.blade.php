<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Messages</title>
    <script src="[https://cdn.tailwindcss.com](https://cdn.tailwindcss.com)"></script>
</head>
<body class="bg-gray-100 p-10 min-h-screen">

<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">My Message History</h1>
        <div class="flex gap-4">
            <a href="{{ route('contact.form') }}" class="text-blue-600 underline">New Message</a>
            <!-- Logout link for convenience -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 underline">Logout</button>
            </form>
        </div>
    </div>

    @if($messages->isEmpty())
        <div class="bg-white p-10 rounded shadow text-center">
            <p class="text-gray-500 text-lg">You haven't sent any messages yet.</p>
            <a href="{{ route('contact.form') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Contact Us</a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($messages as $msg)
                <div class="bg-white rounded shadow overflow-hidden border-l-4 {{ $msg->admin_reply ? 'border-green-500' : 'border-yellow-500' }}">
                    <div class="p-4 bg-gray-50 flex justify-between items-center border-b">
                        <span class="font-bold text-lg">{{ $msg->subject }}</span>
                        <span class="text-sm text-gray-500">{{ $msg->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-800 mb-4">{{ $msg->message }}</p>
                        
                        @if($msg->admin_reply)
                            <div class="mt-4 bg-green-50 p-4 rounded border border-green-200">
                                <p class="text-green-800 font-bold text-sm mb-1">Admin Reply:</p>
                                <p class="text-gray-700">{{ $msg->admin_reply }}</p>
                                <p class="text-xs text-gray-400 mt-2">Replied: {{ $msg->replied_at->diffForHumans() }}</p>
                            </div>
                        @else
                            <div class="mt-4 text-yellow-600 text-sm italic flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Awaiting reply from admin...
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
