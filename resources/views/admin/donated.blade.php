<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Donation Management</title>
    
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
        
        /* Cards */
        .stat-card { background: #fff; border-radius: 12px; padding: 1.5rem; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); height: 100%; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-box { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 1.2rem; margin-right: 1rem; }
        .bg-green-light { background-color: #dcfce7; color: #16a34a; }
        .bg-blue-light { background-color: #dbeafe; color: #2563eb; }
        .bg-purple-light { background-color: #e0e7ff; color: #4f46e5; }
        
        .custom-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.02); margin-bottom: 2rem; }
        .card-header { background: #fff; border-bottom: 1px solid #f0f0f0; padding: 1.5rem; border-radius: 12px 12px 0 0; font-weight: 600; }
        .table th { font-size: 0.85rem; text-transform: uppercase; color: #8898aa; font-weight: 600; padding: 1rem; }
        .table td { padding: 1rem; vertical-align: middle; color: #525f7f; }

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
            <h4 class="fw-bold mb-0">Donations</h4>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark d-none d-md-block">Donations Overview</h3>
                <p class="text-muted mb-0 d-none d-md-block">Track incoming funds and donor activity</p>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Amount -->
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center">
                    <div class="icon-box bg-green-light"><i class="fas fa-dollar-sign"></i></div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase fw-bold">Total Collected</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ number_format($donations->where('status','success')->sum('amount'), 2) }} <small class="text-muted fs-6">USD</small></h4>
                    </div>
                </div>
            </div>
            <!-- Total Transactions -->
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center">
                    <div class="icon-box bg-blue-light"><i class="fas fa-receipt"></i></div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase fw-bold">Transactions</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ $donations->count() }}</h4>
                    </div>
                </div>
            </div>
            <!-- Top Purpose -->
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center">
                    <div class="icon-box bg-purple-light"><i class="fas fa-star"></i></div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase fw-bold">Top Cause</h6>
                        <h5 class="fw-bold mb-0 text-dark text-truncate" style="max-width: 150px;">
                            {{ $chartPurpose->sortByDesc('total_amount')->first()->purpose ?? 'N/A' }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4 mb-4">
            <!-- Doughnut Chart (Purpose) -->
            <div class="col-lg-4">
                <div class="custom-card h-100 mb-0">
                    <div class="card-header border-0 pb-0 px-0 pt-0 mb-3">
                        <h5 class="fw-bold">By Purpose</h5>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="purposeChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Line Chart (Trend) -->
            <div class="col-lg-8">
                <div class="custom-card h-100 mb-0">
                    <div class="card-header border-0 pb-0 px-0 pt-0 mb-3">
                        <h5 class="fw-bold">Donation Trends (30 Days)</h5>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Donations Table -->
        <div class="custom-card p-0 overflow-hidden">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Recent Transactions</h5>
                
                <!-- Filter Form -->
                <form action="{{ route('admin.donations') }}" method="GET" class="d-flex gap-2">
                    <select name="purpose" class="form-select form-select-sm shadow-sm border-0 bg-light" style="width: 180px;" onchange="this.form.submit()">
                        <option value="all">All Purposes</option>
                        @foreach($allPurposes as $p)
                            <option value="{{ $p }}" {{ request('purpose') == $p ? 'selected' : '' }}>
                                {{ $p }}
                            </option>
                        @endforeach
                    </select>
                    @if(request('purpose') && request('purpose') != 'all')
                        <a href="{{ route('admin.donations') }}" class="btn btn-sm btn-light text-danger"><i class="fas fa-times"></i></a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Donor Info</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $donation->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $donation->first_name ?: 'Anonymous' }} {{ $donation->last_name }}</div>
                                <small class="text-muted">{{ $donation->email }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info px-2 py-1">
                                    {{ ucfirst($donation->purpose) }}
                                </span>
                            </td>
                            <td class="fw-bold text-success">${{ number_format($donation->amount, 2) }}</td>
                            <td>
                                @if($donation->status == 'success')
                                    <span class="badge bg-success rounded-pill"><i class="fas fa-check me-1"></i> Paid</span>
                                @else
                                    <span class="badge bg-warning text-dark rounded-pill">{{ ucfirst($donation->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-2x mb-3 d-block text-secondary"></i>
                                No donation records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Charts Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Toggle Sidebar Function
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        // Purpose Chart
        const ctxPurpose = document.getElementById('purposeChart').getContext('2d');
        const purposeData = @json($chartPurpose);
        
        new Chart(ctxPurpose, {
            type: 'doughnut',
            data: {
                labels: purposeData.map(item => item.purpose),
                datasets: [{
                    data: purposeData.map(item => item.total_amount),
                    backgroundColor: ['#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right', labels: { boxWidth: 10, usePointStyle: true } }
                }
            }
        });

        // Trend Chart
        const ctxTrend = document.getElementById('trendChart').getContext('2d');
        const trendData = @json($chartTrend);

        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: trendData.map(item => item.date),
                datasets: [{
                    label: 'Donations ($)',
                    data: trendData.map(item => item.total),
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3,
                    pointRadius: 3,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                    x: { grid: { display: false } }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>
</body>
</html>
