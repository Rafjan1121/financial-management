<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Holiday &amp; Travel Inc.</title>
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
</head>
<body>
    <div class="app-container">
 
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand-section">
                <div class="brand-row">
                    <span class="brand-icon">🌴</span>
                    <span class="brand-name">Holiday &amp; Travel Inc.</span>
                </div>
                <div class="brand-subtitle">FINANCIAL MANAGEMENT SYSTEM</div>
            </div>
 
            <div class="menu-section">
    <div class="menu-label">MAIN MENU</div>

    <a href="{{ route('admin.dashboard') }}" class="menu-item active">
        <span class="menu-icon">
            <img src="{{ asset('icons/business.png') }}" alt="" class="icon-img">
        </span>
        <span class="menu-text">Dashboard</span>
    </a>

    <a href="#" class="menu-item">
        <span class="menu-icon">
            <img src="{{ asset('icons/management.png') }}" alt="" class="icon-img">
        </span>
        <span class="menu-text">User Management</span>
    </a>

    <a href="{{ route('dashboard') }}" class="menu-item">
        <span class="menu-icon">
            <img src="{{ asset('icons/financial.png') }}" alt="" class="icon-img">
        </span>
        <span class="menu-text">Financial Management</span>
    </a>

    <a href="#" class="menu-item">
        <span class="menu-icon">
            <img src="{{ asset('icons/report.png') }}" alt="" class="icon-img">
        </span>
        <span class="menu-text">Reports</span>
    </a>

    <a href="#" class="menu-item">
        <span class="menu-icon">
            <img src="{{ asset('icons/notification.png') }}" alt="" class="icon-img">
        </span>
        <span class="menu-text">Notifications</span>
        <span class="menu-badge">3</span>
    </a>

    <a href="#" class="menu-item">
        <span class="menu-icon">
            <img src="{{ asset('icons/setting.png') }}" alt="" class="icon-img">
        </span>
        <span class="menu-text">System Settings</span>
    </a>
</div>
 
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">{{ session('user_initials', 'AD') }}</div>
                    <div>
                        <div class="user-name">{{ session('user_name', 'Administrator') }}</div>
                        <div class="user-role">Super Administrator</div>
                    </div>
                </div>
 
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        ↩ Logout System
                    </button>
                </form>
            </div>
        </div>
 
        <!-- Main content -->
        <div class="main-content">
 
            <div class="top-bar-admin">
                <span class="hamburger">☰</span>
 
                <div class="search-box">
                    <span class="search-icon">🔍</span>
                    <input type="text" placeholder="Search anything...">
                </div>
 
                <div class="top-bar-right">
                    <div class="icon-btn">
                        🔔
                        <span class="notif-badge">3</span>
                    </div>
                    <div class="icon-btn">✉️</div>
                </div>
            </div>
 
            <div class="welcome-banner">
                <div class="welcome-text">
                    <p class="welcome-greeting">Welcome back,</p>
                    <h1>Administrator 👋</h1>
                    <p class="welcome-subtitle">Here's what's happening with your system today.</p>
                </div>
                <div class="welcome-illustration">✈️ 🗼 🏰</div>
            </div>
 
            <div class="content-body">
 
                <div class="kpi-grid">
                    <div class="kpi-card">
                        <div class="kpi-icon icon-blue">👛</div>
                        <div class="kpi-label">TOTAL REVENUE</div>
                        <div class="kpi-value">₱{{ number_format($stats['total_revenue'], 2) }}</div>
                        <div class="kpi-change up">↑ {{ $stats['revenue_change'] }}% vs last month</div>
                    </div>
 
                    <div class="kpi-card">
                        <div class="kpi-icon icon-orange">⬇️</div>
                        <div class="kpi-label">TOTAL EXPENSES</div>
                        <div class="kpi-value">₱{{ number_format($stats['total_expenses'], 2) }}</div>
                        <div class="kpi-change up">↑ {{ $stats['expenses_change'] }}% vs last month</div>
                    </div>
 
                    <div class="kpi-card">
                        <div class="kpi-icon icon-green">📈</div>
                        <div class="kpi-label">NET PROFIT</div>
                        <div class="kpi-value">₱{{ number_format($stats['net_profit'], 2) }}</div>
                        <div class="kpi-change up">↑ {{ $stats['profit_change'] }}% vs last month</div>
                    </div>
 
                    <div class="kpi-card">
                        <div class="kpi-icon icon-purple">🏦</div>
                        <div class="kpi-label">CASH BALANCE</div>
                        <div class="kpi-value">₱{{ number_format($stats['cash_balance'], 2) }}</div>
                        <div class="kpi-change up">↑ {{ $stats['cash_change'] }}% vs last month</div>
                    </div>
                </div>
 
                <div class="two-column">
                    <div class="panel chart-panel">
                        <div class="panel-header">
                            <h3>MONTHLY REVENUE OVERVIEW</h3>
                            <button class="year-btn">This Year ▾</button>
                        </div>
                        <canvas id="revenueChart" height="90"></canvas>
                    </div>
 
                    <div class="panel activities-panel">
                        <div class="panel-header">
                            <h3>RECENT ACTIVITIES</h3>
                            <button class="view-all-btn">View All</button>
                        </div>
 
                        @foreach ($activities as $activity)
                            <div class="activity-item">
                                <div class="activity-icon">{{ $activity['icon'] }}</div>
                                <div class="activity-text">
                                    <div class="activity-title">{{ $activity['title'] }}</div>
                                    <div class="activity-subtitle">{{ $activity['subtitle'] }}</div>
                                </div>
                                <div class="activity-time">{{ $activity['time'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
 
                <div class="kpi-grid">
                    <div class="kpi-card">
                        <div class="kpi-icon icon-blue">👥</div>
                        <div class="kpi-label">TOTAL USERS</div>
                        <div class="kpi-value-lg">{{ $stats['total_users'] }}</div>
                        <div class="kpi-change up">↑ {{ $stats['new_users'] }} new this month</div>
                    </div>
 
                    <div class="kpi-card">
                        <div class="kpi-icon icon-green">🟢</div>
                        <div class="kpi-label">ACTIVE USERS</div>
                        <div class="kpi-value-lg">{{ $stats['active_users'] }}</div>
                        <div class="kpi-change muted">Currently online</div>
                    </div>
 
                    <div class="kpi-card">
                        <div class="kpi-icon icon-orange">🖥️</div>
                        <div class="kpi-label">SYSTEM STATUS</div>
                        <div class="kpi-value-sm">All Systems</div>
                        <div class="status-pill">Operational</div>
                    </div>
 
                    <div class="kpi-card">
                        <div class="kpi-icon icon-purple">📋</div>
                        <div class="kpi-label">PENDING TASKS</div>
                        <div class="kpi-value-lg">{{ $stats['pending_tasks'] }}</div>
                        <div class="kpi-change muted">Requires attention</div>
                    </div>
                </div>
 
            </div>
        </div>
 
    </div>
 
    <script>
        const ctx = document.getElementById('revenueChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartValues) !!},
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249, 115, 22, 0.08)',
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#f97316',
                    pointRadius: 4,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000000) return (value / 1000000) + 'M';
                                if (value >= 1000) return (value / 1000) + 'K';
                                return value;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
 