<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --sidebar-width: 260px; --primary-color: #435ebe; --bg-color: #f2f7ff; --text-color: #607080; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-color); color: var(--text-color); overflow-x: hidden; }
        
        /* Sidebar */
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: #fff; box-shadow: 0 0 15px rgba(0,0,0,0.05); z-index: 1000; transition: all 0.3s; }
        .sidebar-header { padding: 2rem 2rem 1rem; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #f0f0f0; }
        .sidebar-menu { padding: 1.5rem; }
        .menu-link { display: flex; align-items: center; padding: 12px 15px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: all 0.3s; font-weight: 500; }
        .menu-link:hover, .menu-link.active { background-color: var(--primary-color); color: #fff; box-shadow: 0 4px 10px rgba(67, 94, 190, 0.3); }
        .menu-link i { margin-right: 15px; width: 20px; text-align: center; }

        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); padding: 2rem; }
        
        /* Cards */
        .stat-card { background: #fff; border-radius: 12px; padding: 1.5rem; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); height: 100%; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-box { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1rem; }
        .stat-purple { background: #efeaff; color: #886cff; }
        .stat-blue { background: #e7f2ff; color: #435ebe; }
        .stat-green { background: #e0ffef; color: #2dce89; }
        .stat-orange { background: #fff4de; color: #ffa21d; }
        
        /* General Utils */
        .custom-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); padding: 1.5rem; margin-bottom: 2rem; }
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
        <h3 class="fw-bold text-dark mb-4">Admin Dashboard Overview</h3>

        <!-- Stats Grid -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="icon-box stat-blue"><i class="fa-solid fa-users"></i></div>
                    <h6 class="text-muted text-uppercase small fw-bold">Total Users</h6>
                    <h2 class="mb-0 fw-bold">{{ \App\Models\User::count() }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="icon-box stat-purple"><i class="fa-solid fa-calendar-days"></i></div>
                    <h6 class="text-muted text-uppercase small fw-bold">Total Events</h6>
                    <h2 class="mb-0 fw-bold">{{ \App\Models\Event::count() ?? 0 }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="icon-box stat-orange"><i class="fa-solid fa-newspaper"></i></div>
                    <h6 class="text-muted text-uppercase small fw-bold">Total Blogs</h6>
                    <h2 class="mb-0 fw-bold">{{ \App\Models\Blog::count() ?? 0 }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="icon-box stat-green"><i class="fa-solid fa-check-circle"></i></div>
                    <h6 class="text-muted text-uppercase small fw-bold">System Status</h6>
                    <h2 class="mb-0 fw-bold fs-4">Online</h2>
                </div>
            </div>
        </div>

        <!-- Quick Actions / Welcome -->
        <div class="custom-card">
            <h5 class="fw-bold mb-3">Welcome back, {{ Auth::user()->username ?? 'Admin' }}!</h5>
            <p class="text-muted">Use the sidebar to navigate through the management sections.</p>
            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary"><i class="fa-solid fa-user-gear me-2"></i> Manage Users</a>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary"><i class="fa-solid fa-plus me-2"></i> Add Event</a>
            </div>
        </div>
    </div>

</body>
</html>