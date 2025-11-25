<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Blog Management</title>
    
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
        
        /* Mobile Overlay */
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999; }

        /* Blog Specific */
        .blog-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); overflow: hidden; height: 100%; transition: transform 0.2s; }
        .blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .blog-img { height: 180px; object-fit: cover; width: 100%; }
        .blog-body { padding: 1.5rem; }
        .custom-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); padding: 1.5rem; margin-bottom: 2rem; }

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
            <h4 class="fw-bold mb-0">Blog Posts</h4>
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
            <div>
                <h3 class="fw-bold text-dark d-none d-md-block">Blog Posts</h3>
                <p class="text-muted mb-0 d-none d-md-block">Manage community articles and updates</p>
            </div>
            
            <div class="d-flex gap-2 ms-auto ms-md-0">
                <!-- Category Filter -->
                <form action="{{ route('admin.blogs.index') }}" method="GET" class="d-flex gap-2">
                    <select class="form-select w-auto shadow-sm border-0" name="category" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </form>
                
                <!-- Create Button (Triggers Collapse) -->
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#createBlogCard">
                    <i class="fa-solid fa-plus me-2"></i> New Post
                </button>
            </div>
        </div>

        <!-- CREATE BLOG FORM (Collapsible) -->
        <div class="collapse mb-4" id="createBlogCard">
            <div class="custom-card border-start border-4 border-primary">
                <h5 class="fw-bold mb-3">Create New Blog Post</h5>
                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Category</label>
                            <input type="text" name="category" class="form-control" list="categoryOptions" placeholder="Type or select..." required>
                            <!-- Datalist for existing categories -->
                            <datalist id="categoryOptions">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-muted small fw-bold">Content</label>
                            <textarea name="content" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-muted small fw-bold">Featured Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-toggle="collapse" data-bs-target="#createBlogCard">Cancel</button>
                            <button type="submit" class="btn btn-primary">Publish Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- BLOG GRID -->
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card">
                        <div class="position-relative">
                            @if($blog->image)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($blog->image) }}" class="blog-img">
                            @else
                                <div class="blog-img bg-light d-flex align-items-center justify-content-center text-muted">
                                    <i class="fa-regular fa-image fa-2x"></i>
                                </div>
                            @endif
                            <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm">{{ $blog->category }}</span>
                        </div>
                        
                        <div class="blog-body">
                            <h5 class="fw-bold text-dark mb-2">{{ Str::limit($blog->title, 40) }}</h5>
                            <p class="text-muted small">{{ Str::limit($blog->content, 90) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <small class="text-muted">By {{ $blog->user->username ?? 'Unknown' }}</small>
                                
                                <div class="btn-group">
                                    <!-- Edit (Modal Trigger) -->
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editBlogModal{{ $blog->id }}" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    
                                    <!-- Delete -->
                                    <form action="{{ route('blogs.delete', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================== -->
                <!--  EDIT BLOG MODAL           -->
                <!-- ========================== -->
                <div class="modal fade" id="editBlogModal{{ $blog->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title fw-bold">Edit Blog: {{ $blog->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Important for Update -->
                                
                                <div class="modal-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small fw-bold">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small fw-bold">Category</label>
                                            <input type="text" name="category" class="form-control" value="{{ $blog->category }}" list="categoryOptions" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label text-muted small fw-bold">Content</label>
                                            <textarea name="content" class="form-control" rows="5" required>{{ $blog->content }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label text-muted small fw-bold">Current Image</label>
                                            <div class="d-flex align-items-center gap-3 mb-2">
                                                @if($blog->image)
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($blog->image) }}" class="rounded border" width="80">
                                                    <small class="text-success"><i class="fa-solid fa-check"></i> Loaded</small>
                                                @else
                                                    <span class="text-muted small">No image</span>
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
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <i class="fa-regular fa-newspaper fa-3x mb-3"></i>
                        <h5>No blogs found.</h5>
                        <p>No blog posts have been created yet.</p>
                    </div>
                </div>
            @endforelse
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
