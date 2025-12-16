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
        
        /* Image Thumbnail */
        .receipt-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; cursor: pointer; transition: transform 0.2s; }
        .receipt-thumb:hover { transform: scale(1.1); }

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
                            <th class="ps-4">Applicant</th>
                            <th>Details (Age/Gen/Addr)</th>
                            <th>Payment Verification</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                        <tr>
                            <!-- Applicant Basics -->
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $reg->name }}</div>
                                <div class="small text-muted"><i class="fa-solid fa-envelope me-1"></i>{{ $reg->email }}</div>
                                <div class="small text-muted"><i class="fa-solid fa-phone me-1"></i>{{ $reg->phone }}</div>
                            </td>

                            <!-- Details (New Fields) -->
                            <td>
                                <div class="small text-dark">
                                    <span class="badge bg-secondary bg-opacity-10 text-dark">{{ $reg->gender ?? 'N/A' }}</span>
                                    <span class="text-muted mx-1">|</span> 
                                    Age: {{ $reg->age ?? 'N/A' }}
                                </div>
                                <div class="small text-muted mt-1" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $reg->address }}">
                                    <i class="fa-solid fa-location-dot me-1"></i> {{ $reg->address ?? 'No Address' }}
                                </div>
                            </td>

                            <!-- Payment Verification -->
                            <td>
                                @if($reg->payment_receipt_path)
                                    <!-- Display Thumbnail linked to full image -->
                                    <a href="{{ asset('storage/' . $reg->payment_receipt_path) }}" target="_blank" title="View Receipt">
                                        <img src="{{ asset('storage/' . $reg->payment_receipt_path) }}" class="receipt-thumb" alt="Receipt">
                                    </a>
                                    <div class="small text-muted mt-1">Photo Uploaded</div>
                                @elseif($reg->payment_receipt_number)
                                    <!-- Display Reference Number -->
                                    <div class="fw-bold text-primary">{{ $reg->payment_receipt_number }}</div>
                                    <div class="small text-muted">Ref Number</div>
                                @else
                                    <span class="badge bg-light text-muted border">Not Provided</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td>
                                @if($reg->status == 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-2 py-1 rounded-pill">Approved</span>
                                @elseif($reg->status == 'denied')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-2 py-1 rounded-pill">Denied</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-2 py-1 rounded-pill">Pending</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <!-- Edit Button (Triggers Modal) -->
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editRegModal{{ $reg->id }}">
                                        <i class="fa-solid fa-eye me-1"></i> Review
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- ========================== -->
                        <!--  EDIT/REVIEW MODAL         -->
                        <!-- ========================== -->
                        <div class="modal fade" id="editRegModal{{ $reg->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-lg for more space -->
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title fw-bold">Review Registration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    
                                    <form action="{{ route('admin.registrations.update', $reg->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="modal-body p-4">
                                            <div class="row">
                                                <!-- Left Col: Personal Details -->
                                                <div class="col-md-6">
                                                    <h6 class="text-primary fw-bold mb-3">Personal Information</h6>
                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small fw-bold">Full Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $reg->name }}" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <label class="form-label text-muted small fw-bold">Gender</label>
                                                            <select name="gender" class="form-select">
                                                                <option value="Male" {{ $reg->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                                <option value="Female" {{ $reg->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label class="form-label text-muted small fw-bold">Age</label>
                                                            <input type="number" name="age" class="form-control" value="{{ $reg->age }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small fw-bold">Phone</label>
                                                        <input type="text" name="phone" class="form-control" value="{{ $reg->phone }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small fw-bold">Address</label>
                                                        <input type="text" name="address" class="form-control" value="{{ $reg->address }}">
                                                    </div>
                                                </div>

                                                <!-- Right Col: Payment & Status -->
                                                <div class="col-md-6">
                                                    <h6 class="text-primary fw-bold mb-3">Payment & Status</h6>
                                                    
                                                    <!-- Payment Display -->
                                                    <div class="p-3 bg-light rounded mb-3 border">
                                                        <label class="d-block text-muted small fw-bold mb-2">Payment Verification</label>
                                                        @if($reg->payment_receipt_path)
                                                            <div class="text-center">
                                                                <img src="{{ asset('storage/' . $reg->payment_receipt_path) }}" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                                                <br>
                                                                <a href="{{ asset('storage/' . $reg->payment_receipt_path) }}" target="_blank" class="btn btn-sm btn-outline-dark">View Full Image</a>
                                                            </div>
                                                        @else
                                                            <label class="form-label text-muted small">Reference Number:</label>
                                                            <input type="text" name="payment_receipt_number" class="form-control" value="{{ $reg->payment_receipt_number }}">
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small fw-bold">Registration Status</label>
                                                        <select name="status" class="form-select bg-white border-primary">
                                                            <option value="pending" {{ $reg->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="approved" {{ $reg->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="denied" {{ $reg->status == 'denied' ? 'selected' : '' }}>Denied</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small fw-bold">Other Notes</label>
                                                        <textarea name="other_information" class="form-control" rows="2">{{ $reg->other_information }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Registration</button>
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
                                <p>No registrations found.</p>
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
