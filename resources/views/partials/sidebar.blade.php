<div class="sidebar">
    <div class="brand-section">
        <div class="brand-row">
            <span class="brand-icon">💰</span>
            <span class="brand-name">Financial<br>Management</span>
        </div>
        <div class="brand-subtitle">TRANSACTION CORE</div>
    </div>
 
    <div class="menu-section">
        <div class="menu-label">MAIN MENU</div>
 
        @php
            $modules = [
                'general-ledger'          => 'General Ledger',
                'accounts-payable'        => 'Accounts Payable (AP)',
                'accounts-receivable'     => 'Accounts Receivable (AR)',
                'disbursement-management' => 'Disbursement Management',
                'collection-management'   => 'Collection Management',
                'budget-management'       => 'Budget Management',
                'cash-management'         => 'Cash Management',
                'financial-reporting'     => 'Financial Reporting & Analytics',
                'tax-management'          => 'Tax Management',
            ];
 
            // Same custom icon filenames you set up earlier —
            // update these if you rename any of the image files.
            $icons = [
                'general-ledger'          => 'ledger.png',
                'accounts-payable'        => 'accounts-payable.png',
                'accounts-receivable'     => 'receivable.png',
                'disbursement-management' => 'database-management.png',
                'collection-management'   => 'earning.png',
                'budget-management'       => 'cash-flow.png',
                'cash-management'         => 'money.png',
                'financial-reporting'     => 'graph.png',
                'tax-management'          => 'tax.png',
            ];
        @endphp
 
        @foreach ($modules as $slug => $label)
            <a href="{{ $slug === 'accounts-receivable' ? route('module.ar') : route('module.show', $slug) }}"
               class="menu-item {{ ($currentSlug ?? '') === $slug ? 'active' : '' }}">
                <span class="menu-icon">
                    <img src="{{ asset('icons/' . $icons[$slug]) }}" alt="" class="icon-img">
                </span>
                <span class="menu-text">{{ $label }}</span>
            </a>
        @endforeach
    </div>
 
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">OP</div>
            <div>
                <div class="user-name">Operation Admin</div>
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