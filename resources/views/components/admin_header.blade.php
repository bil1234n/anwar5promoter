<!-- resources/views/components/admin_header.blade.php -->

<!-- Mobile Overlay (Background Dimmer) -->
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar Navigation -->
<div class="sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <h4 class="mb-0 fw-bold d-flex justify-content-between align-items-center w-100" style="color: var(--primary-color);">
            <img src="{{ asset('assets/img/logo/logo_a_3.png') }}" loading="lazy" alt="Anwar5Promoter" style="width: 150px;">
            
            <!-- Mobile Close Button -->
            <button class="btn btn-sm btn-light d-md-none text-danger" onclick="toggleSidebar()">
                <i class="fa-solid fa-xmark fa-lg"></i>
            </button>
        </h4>
    </div>
    
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}" class="menu-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i> Users
        </a>
        <a href="{{ route('admin.events.index') }}" class="menu-link {{ request()->routeIs('admin.events.index') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-check"></i> Events
        </a>
        <a href="{{ route('admin.blogs.index') }}" class="menu-link {{ request()->routeIs('admin.blogs.index') ? 'active' : '' }}">
            <i class="fa-solid fa-newspaper"></i> Blogs
        </a>
        <a href="{{ route('admin.donations') }}" class="menu-link {{ request()->routeIs('admin.donations') ? 'active' : '' }}">
            <i class="fa-solid fa-hand-holding-dollar"></i> Donations
        </a>
        <a href="{{ route('admin.messages') }}" class="menu-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
            <i class="fa-solid fa-envelope"></i> Messages
        </a>
        
        <div class="mt-5 border-top pt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100">
                    <i class="fa-solid fa-power-off me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>
