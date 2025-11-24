<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Messages</title>
    
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
        
        .custom-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); margin-bottom: 2rem; }
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
            <a href="{{ route('admin.events.index') }}" class="menu-link"><i class="fa-solid fa-calendar-check"></i> Events</a>
            <a href="{{ route('admin.blogs.index') }}" class="menu-link"><i class="fa-solid fa-newspaper"></i> Blogs</a>
            <a href="{{ route('admin.donations') }}" class="menu-link"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a>
            <!-- Active Messages Link -->
            <a href="{{ route('admin.messages') }}" class="menu-link active"><i class="fa-solid fa-envelope"></i> Messages</a>
            
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
        
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark">Incoming Messages</h3>
                <p class="text-muted mb-0">Queries from the contact form</p>
            </div>
        </div>

        <div class="custom-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Sender Details</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                        <tr>
                            <td class="ps-4 text-muted small" style="width: 120px;">
                                {{ $msg->created_at->format('M d, Y') }}
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $msg->full_name }}</div>
                                <div class="small text-muted">{{ $msg->email }}</div>
                                @if($msg->company)
                                    <div class="small text-muted"><i class="fa-regular fa-building me-1"></i> {{ $msg->company }}</div>
                                @endif
                                
                                <div class="mt-1">
                                    @if($msg->user_id)
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-2">Registered User</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-2">Guest</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium text-dark">{{ Str::limit($msg->subject, 30) }}</div>
                                <div class="small text-muted text-truncate" style="max-width: 250px;">
                                    {{ Str::limit($msg->message, 50) }}
                                </div>
                            </td>
                            <td>
                                @if($msg->admin_reply)
                                    <span class="badge bg-success rounded-pill"><i class="fa-solid fa-check me-1"></i> Replied</span>
                                @else
                                    <span class="badge bg-warning text-dark rounded-pill"><i class="fa-regular fa-clock me-1"></i> Pending</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal{{ $msg->id }}">
                                    @if($msg->admin_reply) 
                                        <i class="fa-solid fa-eye me-1"></i> View/Edit
                                    @else
                                        <i class="fa-solid fa-reply me-1"></i> Reply
                                    @endif
                                </button>
                            </td>
                        </tr>

                        <!-- Reply Modal -->
                        <div class="modal fade" id="replyModal{{ $msg->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title fw-bold">Reply to {{ $msg->full_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.reply', $msg->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- Original Message -->
                                            <div class="p-3 bg-light rounded border mb-3">
                                                <small class="text-muted fw-bold d-block mb-1">Original Message:</small>
                                                <p class="mb-0 small text-dark fst-italic">"{{ $msg->message }}"</p>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold small text-muted">Your Reply</label>
                                                <textarea name="reply_message" class="form-control" rows="5" placeholder="Type your response here..." required>{{ $msg->admin_reply }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa-solid fa-paper-plane me-1"></i> Send Reply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-envelope-open fa-2x mb-3"></i>
                                <p>No messages found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                {{ $messages->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>