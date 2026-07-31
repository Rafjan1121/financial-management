<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Financial Management System</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="app-container">
 
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand-section">
                <div class="brand-row">
                    <span class="brand-icon">💰</span>
                    <span class="brand-name">Holiday & Travel<br>Inc.   </span>
                </div>
                <div class="brand-subtitle">FINANCIAL MANAGEMENT SYSTEM</div>
            </div>
 
            <div class="menu-section">
                <div class="menu-label">MAIN MENU</div> 
 
                @foreach ($modules as $slug => $label)
                    <a href="{{ route('module.show', $slug) }}"
                       class="menu-item {{ $slug === $currentSlug ? 'active' : '' }}">
                        <span class="menu-icon">
    @if (str_ends_with($icons[$slug] ?? '', '.png'))
        <img src="{{ asset('icons/' . $icons[$slug]) }}" alt="" class="icon-img">
    @else
        {{ $icons[$slug] ?? '📄' }}
    @endif
</span>
                        <span class="menu-text">{{ $label }}</span>
                    </a>
                @endforeach
            </div>
 
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">{{ auth()->user()->initials ?? 'OP' }}</div>
                    <div>
                        <div class="user-name">{{ auth()->user()->name ?? 'Operation Admin' }}</div>
                        <div class="user-role">Head Manager</div>
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
            <div class="top-bar">
                <h1>{{ $title }}</h1>
            </div>
 
            <div class="content-body">
                <div class="page-header">
                    <div>
                        <h2>{{ $title }}</h2>
                        <p class="page-description">{{ $descriptions[$currentSlug] ?? 'Manage records for this module.' }}</p>
                    </div>
                    <button class="btn-primary">＋ Add New</button>
                </div>
 
                <div class="placeholder-card">
                    <p>This is the <strong>{{ $title }}</strong> module.</p>
                    <p class="muted">Records and tools for this section will appear here.</p>
                </div>
            </div>
        </div>
 
    </div>
</body>
</html>