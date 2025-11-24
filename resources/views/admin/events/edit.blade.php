<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
    <div class="container" style="max-width: 700px;">
        <div class="card">
            <div class="card-header">
                <h4>Edit Event: {{ $event->title }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Event Date</label>
                        <input type="datetime-local" name="event_date" class="form-control" value="{{ $event->event_date }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $event->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Current Image</label><br>
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" width="100" class="mb-2">
                        @else
                            <p class="text-muted">No image uploaded</p>
                        @endif
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <button class="btn btn-primary">Update Event</button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>