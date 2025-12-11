<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Support History</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter for professional typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800">

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between mb-8 border-b border-slate-200 pb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Message History</h1>
            <p class="mt-1 text-sm text-slate-500">View your past inquiries and administrative responses.</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center space-x-4">
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-medium text-slate-500 hover:text-red-600 transition-colors">
                    Log Out
                </button>
            </form>
            <!-- New Message Action -->
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                🏠
                Home
            </a>
            <a href="{{ route('contact.form') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Message
            </a>
        </div>
    </div>

    <!-- Content Area -->
    @if($messages->isEmpty())
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="mx-auto h-12 w-12 text-slate-300 mb-4">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            </div>
            <h3 class="text-lg font-medium text-slate-900">No messages yet</h3>
            <p class="mt-1 text-slate-500 max-w-sm mx-auto">You haven't contacted support yet. If you need help, feel free to send us a message.</p>
            <div class="mt-6">
                <a href="{{ route('contact.form') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Contact Support
                </a>
            </div>
        </div>
    @else
        <!-- Message List -->
        <div class="space-y-6">
            @foreach($messages as $msg)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden transition hover:shadow-md">
                    
                    <!-- Card Header -->
                    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <div class="flex items-start gap-4">
                            <!-- Status Icon/Badge -->
                            <div class="flex-shrink-0 mt-1">
                                @if($msg->admin_reply)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        Replied
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        Pending
                                    </span>
                                @endif
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900">{{ $msg->subject }}</h2>
                                <p class="text-xs text-slate-400 mt-1">Ticket ID: #{{ $msg->id }} &bull; Sent {{ $msg->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-sm text-slate-500 whitespace-nowrap">
                            {{ $msg->created_at->format('M d, Y') }}
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <!-- User Message -->
                        <div class="mb-6">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Your Message</p>
                            <p class="text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100">
                                {{ $msg->message }}
                            </p>
                        </div>
                        
                        <!-- Admin Reply Section -->
                        @if($msg->admin_reply)
                            <div class="mt-6 flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="font-bold text-slate-900">Support Team</h4>
                                        <span class="text-xs text-slate-500">{{ $msg->replied_at ? $msg->replied_at->format('M d, h:i A') : '' }}</span>
                                    </div>
                                    <div class="text-slate-600 prose prose-sm max-w-none">
                                        {{ $msg->admin_reply }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mt-4 flex items-center p-4 bg-yellow-50 rounded-lg border border-yellow-100 text-yellow-700 text-sm">
                                <svg class="w-5 h-5 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Our support team has received your message and will reply shortly.</span>
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
