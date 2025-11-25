<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | User Management</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #435ebe;
            --bg-color: #f2f7ff;
            --text-color: #607080;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            overflow-x: hidden;
        }

        /* --- Sidebar Styling --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 2rem 2rem 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #f0f0f0;
        }

        .sidebar-menu {
            padding: 1.5rem;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #555;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .menu-link:hover, .menu-link.active {
            background-color: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 10px rgba(67, 94, 190, 0.3);
        }

        .menu-link i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        /* --- Main Content --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s;
        }

        /* --- Stats Cards --- */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
            position: relative;
            overflow: hidden;
            transition: transform 0.2s;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .stat-purple { background: #efeaff; color: #886cff; }
        .stat-blue { background: #e7f2ff; color: #435ebe; }
        .stat-green { background: #e0ffef; color: #2dce89; }
        .stat-red { background: #ffe5e5; color: #f5365c; }

        /* --- Table Styling --- */
        .custom-card {
            background: #fff;
            border-radius: 12px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .table thead th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            color: #8898aa;
            border-bottom-width: 1px;
            padding: 1rem 1.5rem;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 1rem 1.5rem;
            color: #525f7f;
            font-size: 0.95rem;
        }

        .avatar-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* --- Badges --- */
        .badge-status {
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .bg-approve { background: #e0ffef; color: #2dce89; }
        .bg-pending { background: #fff4de; color: #ffa21d; }
        .bg-suspend { background: #ffe5e5; color: #f5365c; }

        .badge-role {
            background: #f6f9fc;
            color: #5e72e4;
            border: 1px solid #e9ecef;
            padding: 5px 10px;
            border-radius: 4px;
        }

        /* --- Chart Container --- */
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* --- Print Mode --- */
        @media print {
            .sidebar, .no-print { display: none !important; }
            .main-content { margin-left: 0; padding: 0; }
            .custom-card { box-shadow: none; border: 1px solid #ddd; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }
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
            
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
            class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>

            <!-- Users (Uses * to keep active even when editing a user) -->
            <a href="{{ route('admin.users.index') }}" 
            class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Users
            </a>

            <!-- Events -->
            <a href="{{ route('admin.events.index') }}" 
            class="menu-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i> Events
            </a>

            <!-- Blogs -->
            <a href="{{ route('admin.blogs.index') }}" 
            class="menu-link {{ request()->routeIs('admin.blogs.*') || request()->routeIs('blogs.*') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper"></i> Blogs
            </a>

            <!-- Donations -->
            <a href="{{ route('admin.donations') }}" 
            class="menu-link {{ request()->routeIs('admin.donations') ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding-dollar"></i> Donations
            </a>

            <!-- Messages -->
            <a href="{{ route('admin.messages') }}" 
            class="menu-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                <i class="fa-solid fa-envelope"></i> Messages
            </a>
            
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
        
        <!-- Flash Messages (Errors & Success) -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i> <strong>There were errors with your submission:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark">User Management</h3>
                <p class="text-muted mb-0">Overview and management of registered members</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary no-print" onclick="window.print()">
                    <i class="fa-solid fa-print"></i> Print
                </button>
                <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fa-solid fa-filter"></i> Filters
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="icon-box stat-blue"><i class="fa-solid fa-users"></i></div>
                    <h6 class="text-muted text-uppercase mb-1" style="font-size: 12px; letter-spacing: 1px;">Total Users</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ $totalUsers ?? 0 }}</h2>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="icon-box stat-green"><i class="fa-solid fa-user-clock"></i></div>
                    <h6 class="text-muted text-uppercase mb-1" style="font-size: 12px; letter-spacing: 1px;">Active/Approve</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ $userStatusCounts['approve'] ?? 0 }}</h2>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="icon-box stat-purple"><i class="fa-solid fa-crown"></i></div>
                    <h6 class="text-muted text-uppercase mb-1" style="font-size: 12px; letter-spacing: 1px;">Premium Members</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ $premiumUsers ?? 0 }}</h2>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="icon-box stat-red"><i class="fa-solid fa-ban"></i></div>
                    <h6 class="text-muted text-uppercase mb-1" style="font-size: 12px; letter-spacing: 1px;">Suspended</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ $suspendedUsers ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="custom-card h-100">
                    <h5 class="fw-bold mb-4">Membership Distribution</h5>
                    <div class="chart-container">
                        <canvas id="membershipChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="custom-card h-100">
                    <h5 class="fw-bold mb-4">Account Status</h5>
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="custom-card p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Registered Users List</h5>
                
                <!-- Quick Search -->
                <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Search..." value="{{ request('search') }}">
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>User Profile</th>
                            <th>Contact Info</th>
                            <th>Role / Member</th>
                            <th>Docs</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <!-- Profile -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url( $user->profile_p) }}" 
                                         onerror="this.src='https://ui-avatars.com/api/?name={{urlencode($user->username)}}&background=random'" 
                                         class="avatar-img me-3" alt="avatar">
                                    <div>
                                        <div class="fw-bold text-dark">{{ $user->username }}</div>
                                        <small class="text-muted">ID: #{{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Contact -->
                            <td>
                                <div class="text-dark">{{ $user->email }}</div>
                                <small class="text-muted">{{ $user->phoneNo ?? 'N/A' }}</small>
                            </td>

                            <!-- Role/Member -->
                            <td>
                                <div class="mb-1">
                                    <span class="badge-role">{{ ucfirst($user->role) }}</span>
                                </div>
                                <small class="fw-bold 
                                    {{ $user->member_status == 'premium' ? 'text-primary' : 
                                      ($user->member_status == 'gold' ? 'text-warning' : 'text-secondary') }}">
                                    <i class="fa-solid fa-star me-1"></i> {{ ucfirst($user->member_status) }}
                                </small>
                            </td>

                            <!-- Docs -->
                            <td>
                                @if($user->id_card || $user->passport)
                                    <div class="d-flex gap-2">
                                        @if($user->id_card)
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($user->id_card) }}" target="_blank" class="btn btn-sm btn-light text-primary" data-bs-toggle="tooltip" title="View ID">
                                            <i class="fa-regular fa-id-card"></i>
                                        </a>
                                        @endif
                                        @if($user->passport)
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($user->passport) }}" target="_blank" class="btn btn-sm btn-light text-primary" data-bs-toggle="tooltip" title="View Passport">
                                            <i class="fa-solid fa-passport"></i>
                                        </a>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted small">Empty</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td>
                                @php
                                    $statusClass = match($user->status) {
                                        'approve' => 'bg-approve',
                                        'suspend' => 'bg-suspend',
                                        default => 'bg-pending',
                                    };
                                @endphp
                                <span class="badge-status {{ $statusClass }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="text-end">
                                <!-- Trigger Modal -->
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                            </td>
                        </tr>

                        <!-- ========================== -->
                        <!--  FULL EDIT MODAL (UPDATED) -->
                        <!-- ========================== -->
                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Made Modal Larger -->
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title fw-bold">Edit User: {{ $user->username }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    
                                    <!-- FORM POINTS TO UPDATE USER -->
                                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                
                                                <!-- 1. PERSONAL DETAILS (Required by Controller) -->
                                                <div class="col-12 text-uppercase text-muted small fw-bold border-bottom pb-2 mb-2">Personal Details</div>
                                                
                                                <div class="col-md-6">
                                                    <label class="form-label text-muted small fw-bold">Username</label>
                                                    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label text-muted small fw-bold">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label text-muted small fw-bold">Phone No</label>
                                                    <input type="text" name="phoneNo" class="form-control" value="{{ old('phoneNo', $user->phoneNo) }}">
                                                </div>

                                                <!-- 2. ADMIN CONTROLS -->
                                                <div class="col-12 text-uppercase text-muted small fw-bold border-bottom pb-2 mb-2 mt-4">Account Settings</div>

                                                <div class="col-md-4">
                                                    <label class="form-label text-muted small fw-bold">User Role</label>
                                                    <select name="role" class="form-select">
                                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label text-muted small fw-bold">Membership</label>
                                                    <select name="member_status" class="form-select">
                                                        <option value="none" {{ $user->member_status == 'none' ? 'selected' : '' }}>None</option>
                                                        <option value="silver" {{ $user->member_status == 'silver' ? 'selected' : '' }}>Silver</option>
                                                        <option value="gold" {{ $user->member_status == 'gold' ? 'selected' : '' }}>Gold</option>
                                                        <option value="premium" {{ $user->member_status == 'premium' ? 'selected' : '' }}>Premium</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label text-muted small fw-bold">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="approve" {{ $user->status == 'approve' ? 'selected' : '' }}>Approve</option>
                                                        <option value="suspend" {{ $user->status == 'suspend' ? 'selected' : '' }}>Suspend</option>
                                                    </select>
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
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-folder-open fa-2x mb-3"></i>
                                <p>No users found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="p-4 border-top">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>

    <!-- Advanced Filter Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Search Keywords</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Name, Email or Phone">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All</option>
                                <option value="approve" {{ request('status') == 'approve' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="suspend" {{ request('status') == 'suspend' ? 'selected' : '' }}>Suspended</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="">All</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light">Reset</a>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // --- 1. Membership Bar Chart ---
        const memberCtx = document.getElementById('membershipChart').getContext('2d');
        const memberData = @json($memberCounts); 
        
        new Chart(memberCtx, {
            type: 'bar',
            data: {
                labels: ['None', 'Silver', 'Gold', 'Premium'],
                datasets: [{
                    label: 'Users',
                    data: [
                        memberData.none || 0,
                        memberData.silver || 0,
                        memberData.gold || 0,
                        memberData.premium || 0
                    ],
                    backgroundColor: ['#6c757d', '#adb5bd', '#ffc107', '#6f42c1'],
                    borderRadius: 6,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                    x: { grid: { display: false } }
                }
            }
        });

        // --- 2. Status Doughnut Chart ---
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusData = @json($userStatusCounts);
        
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Pending', 'Suspended'],
                datasets: [{
                    data: [
                        statusData.approve || 0, 
                        statusData.pending || 0, 
                        statusData.suspend || 0
                    ],
                    backgroundColor: ['#2dce89', '#ffa21d', '#f5365c'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } }
                }
            }
        });

        // Initialize Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>