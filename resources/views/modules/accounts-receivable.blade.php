<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts Receivable (AR) - Financial Management System</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
</head>
<body>
    <div class="app-container">
 
        @include('partials.sidebar', ['currentSlug' => 'accounts-receivable'])
 
        <div class="main-content">
            <div class="top-bar">
                <h1>Accounts Receivable (AR)</h1>
            </div>
 
            <div class="content-body">
                <div class="page-header">
                    <div>
                        <h2>Online Payment Processing</h2>
                        <p class="page-description">Record customer payments and track which invoices are pending, paid, or overdue.</p>
                    </div>
                    <button class="btn-primary" onclick="document.getElementById('addModal').style.display='flex'">＋ Add New Payment</button>
                </div>
 
                @if (session('success'))
                    <div class="success-box">{{ session('success') }}</div>
                @endif
 
                <table class="module-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Reference No.</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($receivables as $r)
                            <tr>
                                <td>{{ $r['customer_name'] }}</td>
                                <td>{{ $r['reference_no'] }}</td>
                                <td>₱{{ number_format($r['amount'], 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($r['due_date'])->format('M d, Y') }}</td>
                                <td>
                                    @if ($r['status'] === 'paid')
                                        <span class="badge badge-paid">✅ Paid</span>
                                    @elseif ($r['status'] === 'overdue')
                                        <span class="badge badge-overdue">⚠️ Overdue</span>
                                    @else
                                        <span class="badge badge-pending">⏳ Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($r['status'] !== 'paid')
                                        <form method="POST" action="{{ route('ar.markPaid', $r['id']) }}">
                                            @csrf
                                            <button type="submit" class="btn-mark-paid">Mark as Paid</button>
                                        </form>
                                    @else
                                        <span class="muted">Paid {{ \Carbon\Carbon::parse($r['paid_at'])->format('M d, Y') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="no-records">No payment records yet. Click "Add New Payment" to create one.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
 
    </div>
 
    <!-- Add New Payment Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">Add New Payment</div>
 
            <form method="POST" action="{{ route('ar.store') }}">
                @csrf
 
                <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="customer_name" required>
                </div>
 
                <div class="form-group">
                    <label>Reference / Booking No.</label>
                    <input type="text" name="reference_no" required>
                </div>
 
                <div class="form-group">
                    <label>Amount (₱)</label>
                    <input type="number" step="0.01" name="amount" required>
                </div>
 
                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" required>
                </div>
 
                <div class="modal-buttons">
                    <button type="button" class="btn-cancel" onclick="document.getElementById('addModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn-save">Save Payment</button>
                </div>
            </form>
        </div>
    </div>
 
</body>
</html>