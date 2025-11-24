@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Notifications</h2>

    <ul class="list-group">
        @forelse($notifications as $note)
            <li class="list-group-item {{ $note->is_read ? '' : 'bg-light' }}">
                <strong>{{ ucfirst($note->type) }}</strong> — {{ $note->message }}
                <br>
                <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
            </li>
        @empty
            <li class="list-group-item">No notifications yet.</li>
        @endforelse
    </ul>
</div>
@endsection
