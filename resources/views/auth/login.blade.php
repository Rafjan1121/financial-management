<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday Travelers - Workforce Management Admin Portal</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">

            <div class="logo-circle">
                <img src="{{ asset('images/logo.png') }}" alt="Holiday Travelers Logo" onerror="this.style.display='none'; this.parentElement.innerHTML='✈️';">
            </div>

            <h1 class="company-name">Holiday Travelers</h1>
            <p class="company-subtitle">Travel &amp; Tours Inc.</p>
            <p class="portal-label">FINANCIAL MANAGEMENT ADMIN PORTAL</p>

            @if ($errors->any())
                <div class="error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="admin@holidaytravels.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <div class="password-label-row">
                        <label for="password">Password</label>
                        <span class="password-hint">Default: admin123</span>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <button type="submit" class="btn-authenticate">
                    Authenticate Credentials
                </button>

                <a href="{{ route('quick.preview') }}" class="btn-quick-preview">
                    Quick Preview
                </a>
            </form>

        </div>
    </div>
</body>
</html>