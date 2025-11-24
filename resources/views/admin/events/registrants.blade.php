<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Registrants</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --sidebar-width: 260px; --primary-color: #435ebe; --bg-color: #f2f7ff; --text-color: #607080; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-color); color: var(--text-color); overflow-x: hidden; }
        
        /* Sidebar Styling */
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: #fff; box-shadow: 0 0 15px rgba(0,0,0,0.05); z-index: 1000; transition: all 0.3s; }
        .sidebar-header { padding: 2rem 2rem 1rem; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #f0f0f0; }
        .sidebar-menu { padding: 1.5rem; }
        .menu-link { display: flex; align-items: center; padding: 12px 15px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: all 0.3s; font-weight: 500; }
        .menu-link:hover, .menu-link.active { background-color: var(--primary-color); color: #fff; box-shadow: 0 4px 10px rgba(67, 94, 190, 0.3); }
        .menu-link i { margin-right: 15px; width: 20px; text-align: center; }

        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); padding: 2rem; }
        
        .custom-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); padding: 1.5rem; margin-bottom: 2rem; }
        .table th { font-size: 0.85rem; text-transform: uppercase; color: #8898aa; font-weight: 600; padding: 1rem; }
        .table td { padding: 1rem; vertical-align: middle; color: #525f7f; }

        @media (max-width: 768px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0 fw-bold" style="color: var(--primary-color);">
                <img src="{{ asset('assets/img/logo/logo_a_3.png') }}" loading="lazy" alt="Anwar5Promoter" style="width: 200px;">
            </h4>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-link"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="menu-link"><i class="fa-solid fa-users"></i> Users</a>
            <!-- Active Events Link -->
            <a href="{{ route('admin.events.index') }}" class="menu-link active"><i class="fa-solid fa-calendar-check"></i> Events</a>
            <a href="{{ route('admin.blogs.index') }}" class="menu-link"><i class="fa-solid fa-newspaper"></i> Blogs</a>
            <a href="{{ route('admin.donations') }}" class="menu-link"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a>
            <a href="{{ route('admin.messages') }}" class="menu-link"><i class="fa-solid fa-envelope"></i> Messages</a>
            
            <div class="mt-5 border-top pt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger w-100"><i class="fa-solid fa-power-off me-2"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4"><i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}</div>
        @endif

        <!-- Header & Toolbar -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <a href="{{ route('admin.events.index') }}" class="text-decoration-none text-muted small mb-1 d-inline-block">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Events
                </a>
                <h3 class="fw-bold text-dark mb-0">Registrants List</h3>
                <p class="text-muted small mb-0">Event: <span class="fw-semibold text-primary">{{ $event->title }}</span></p>
            </div>

            <!-- Bulk Actions -->
            <div class="d-flex gap-2">
                <form action="{{ route('admin.events.bulk_status', $event->id) }}" method="POST" onsubmit="return confirm('Approve ALL registrants?');">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success shadow-sm">
                        <i class="fa-solid fa-check-double me-2"></i>Approve All
                    </button>
                </form>

                <form action="{{ route('admin.events.bulk_status', $event->id) }}" method="POST" onsubmit="return confirm('Deny ALL registrants?');">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="denied">
                    <button type="submit" class="btn btn-danger shadow-sm">
                        <i class="fa-solid fa-ban me-2"></i>Deny All
                    </button>
                </form>
            </div>
        </div>

        <!-- Registrants Table -->
        <div class="custom-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">User Account</th>
                            <th>Contact Info</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                        <tr>
                            <!-- User Account -->
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $reg->user->username ?? $reg->user->name ?? 'Guest' }}</div>
                                        <small class="text-muted">ID: {{ $reg->user_id }}</small>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact Info -->
                            <td>
                                <div class="fw-medium text-dark">{{ $reg->name }}</div>
                                <div class="small text-muted">{{ $reg->email }}</div>
                                <div class="small text-muted">{{ $reg->phone }}</div>
                            </td>

                            <!-- Date -->
                            <td>
                                <div class="small text-muted">
                                    <i class="fa-regular fa-calendar me-1"></i> {{ $reg->created_at->format('M d, Y') }}
                                </div>
                                <div class="small text-muted">
                                    <i class="fa-regular fa-clock me-1"></i> {{ $reg->created_at->format('h:i A') }}
                                </div>
                            </td>

                            <!-- Status -->
                            <td>
                                @if($reg->status == 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-2 py-1 rounded-pill">
                                        <i class="fa-solid fa-check me-1"></i> Approved
                                    </span>
                                @elseif($reg->status == 'denied')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-2 py-1 rounded-pill">
                                        <i class="fa-solid fa-xmark me-1"></i> Denied
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-2 py-1 rounded-pill">
                                        <i class="fa-regular fa-hourglass me-1"></i> Pending
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    
                                    <!-- Quick Actions (Only if pending) -->
                                    @if($reg->status == 'pending')
                                        <form action="{{ route('admin.registrations.status', $reg->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Approve">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.registrations.status', $reg->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="denied">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Deny">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Edit Button (Triggers Modal) -->
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editRegModal{{ $reg->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- ========================== -->
                        <!--  EDIT REGISTRATION MODAL   -->
                        <!-- ========================== -->
                        <div class="modal fade" id="editRegModal{{ $reg->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title fw-bold">Edit Registration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <!-- Form Action points to updateRegistration -->
                                    <form action="{{ route('admin.registrations.update', $reg->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Full Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $reg->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Email Address</label>
                                                <input type="email" name="email" class="form-control" value="{{ $reg->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Phone Number</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $reg->phone }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="pending" {{ $reg->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved" {{ $reg->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="denied" {{ $reg->status == 'denied' ? 'selected' : '' }}>Denied</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Other Information</label>
                                                <textarea name="other_information" class="form-control" rows="3">{{ $reg->other_information }}</textarea>
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
                                <i class="fa-solid fa-clipboard-list fa-2x mb-3"></i>
                                <p>No registrations found for this event yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>