<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Event Manager</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --sidebar-width: 260px; --primary-color: #435ebe; --bg-color: #f2f7ff; --text-color: #607080; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-color); color: var(--text-color); overflow-x: hidden; }
        
        /* Sidebar Styling */
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: #fff; box-shadow: 0 0 15px rgba(0,0,0,0.05); z-index: 1000; transition: transform 0.3s ease-in-out; }
        .sidebar-header { padding: 2rem 2rem 1rem; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #f0f0f0; }
        .sidebar-menu { padding: 1.5rem; }
        .menu-link { display: flex; align-items: center; padding: 12px 15px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: all 0.3s; font-weight: 500; }
        .menu-link:hover, .menu-link.active { background-color: var(--primary-color); color: #fff; box-shadow: 0 4px 10px rgba(67, 94, 190, 0.3); }
        .menu-link i { margin-right: 15px; width: 20px; text-align: center; }

        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); padding: 2rem; transition: margin-left 0.3s; }
        .custom-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); padding: 1.5rem; margin-bottom: 2rem; }
        
        .table thead th { font-size: 0.85rem; text-transform: uppercase; font-weight: 600; color: #8898aa; border-bottom: 1px solid #e9ecef; padding: 1rem; }
        .table tbody td { vertical-align: middle; padding: 1rem; color: #525f7f; }
        .event-img { width: 80px; height: 50px; object-fit: cover; border-radius: 6px; }

        /* Mobile Overlay */
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999; }

        /* Responsive */
        @media (max-width: 768px) { 
            .sidebar { transform: translateX(-100%); } 
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .main-content { margin-left: 0; padding: 1.5rem; } 
        }
    </style>
</head>
<body>

    <!-- Include Sidebar Component -->
    @include('components.admin_header')

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Mobile Header / Toggle -->
        <div class="d-flex align-items-center mb-4 d-md-none">
            <button class="btn btn-primary me-3" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <h4 class="fw-bold mb-0">Events</h4>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4"><i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark d-none d-md-block">Events Management</h3>
            <!-- Toggle Create Form -->
            <button class="btn btn-primary ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#createEventCard">
                <i class="fa-solid fa-plus me-2"></i> New Event
            </button>
        </div>

        <!-- Create Event Form (Collapsible) -->
        <div class="collapse mb-4" id="createEventCard">
            <div class="custom-card border-start border-4 border-primary">
                <h5 class="fw-bold mb-3">Create New Event</h5>
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Event Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Date & Time</label>
                            <input type="datetime-local" name="event_date" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-muted small fw-bold">Description (Optional)</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-muted small fw-bold">Cover Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-toggle="collapse" data-bs-target="#createEventCard">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Event</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Events Table -->
        <div class="custom-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 120px;">Preview</th>
                            <th>Event Details</th>
                            <th class="d-none d-md-table-cell">Schedule</th>
                            <th>Stats</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr>
                            <td>
                                @if($event->image)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url( $event->image) }}" class="event-img shadow-sm">
                                @else
                                    <div class="event-img bg-light d-flex align-items-center justify-content-center text-muted border">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $event->title }}</div>
                                <!-- Mobile only date -->
                                <small class="text-muted d-md-none d-block">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                                </small>
                                <small class="text-muted d-none d-md-block">{{ Str::limit($event->description ?? '', 50) }}</small>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <div class="text-primary fw-medium">
                                    <i class="fa-regular fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                                </div>
                                <small class="text-muted">
                                    <i class="fa-regular fa-clock me-1"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('h:i A') }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill px-3">
                                    {{ $event->registrations_count ?? 0 }} <span class="d-none d-md-inline">Registrants</span>
                                </span>
                            </td>
                            <td class="text-end">
                                <!-- View Registrants -->
                                <a href="{{ route('admin.events.registrants', $event->id) }}" class="btn btn-sm btn-outline-info" title="View Registrants">
                                    <i class="fa-solid fa-users"></i>
                                </a>
                                
                                <!-- EDIT BUTTON (Opens Modal) -->
                                <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $event->id }}" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <!-- Delete -->
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- ========================== -->
                        <!--  EDIT EVENT MODAL          -->
                        <!-- ========================== -->
                        <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title fw-bold">Edit Event: {{ $event->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label text-muted small fw-bold">Event Title</label>
                                                    <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label text-muted small fw-bold">Date & Time</label>
                                                    <input type="datetime-local" name="event_date" class="form-control" 
                                                           value="{{ date('Y-m-d\TH:i', strtotime($event->event_date)) }}" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label text-muted small fw-bold">Description</label>
                                                    <textarea name="description" class="form-control" rows="3">{{ $event->description }}</textarea>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <label class="form-label text-muted small fw-bold">Current Image</label>
                                                    <div class="d-flex align-items-center gap-3 mb-2">
                                                        @if($event->image)
                                                            <img src="{{ \Illuminate\Support\Facades\Storage::url( $event->image) }}" class="rounded border" width="80">
                                                            <small class="text-success"><i class="fa-solid fa-check"></i> Image loaded</small>
                                                        @else
                                                            <span class="text-muted small">No image uploaded</span>
                                                        @endif
                                                    </div>
                                                    <label class="form-label text-muted small fw-bold">Change Image (Optional)</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-calendar-xmark fa-2x mb-3"></i>
                                <p>No events found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
    </script>
</body>
</html>
