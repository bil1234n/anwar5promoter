<!DOCTYPE html>
<html>
<head>
    <title>Edit Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
    <div class="container" style="max-width: 600px;">
        <div class="card">
            <div class="card-header">
                <h4>Edit User Information</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.registrations.update', $registration->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $registration->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $registration->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $registration->phone }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Other Information</label>
                        <textarea name="other_information" class="form-control" rows="3">{{ $registration->other_information }}</textarea>
                    </div>

                    <button class="btn btn-primary">Update User Info</button>
                    <a href="{{ route('admin.events.registrants', $registration->event_id) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>