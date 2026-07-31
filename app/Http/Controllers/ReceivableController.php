<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Carbon\Carbon;
 
class ReceivableController extends Controller
{
    /**
     * Show the Accounts Receivable page.
     * Data is stored in the session (no database needed yet).
     */
    public function index(Request $request)
    {
        $receivables = $request->session()->get('receivables', []);
 
        // Auto-flag overdue payments
        foreach ($receivables as $id => $r) {
            if ($r['status'] === 'pending' && Carbon::parse($r['due_date'])->isPast()) {
                $receivables[$id]['status'] = 'overdue';
            }
        }
 
        $request->session()->put('receivables', $receivables);
 
        // Sort by due date
        uasort($receivables, fn($a, $b) => strtotime($a['due_date']) <=> strtotime($b['due_date']));
 
        return view('modules.accounts-receivable', [
            'receivables' => $receivables,
        ]);
    }
 
    /**
     * Record a new customer payment / invoice.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'reference_no'  => ['required', 'string', 'max:100'],
            'amount'        => ['required', 'numeric', 'min:0'],
            'due_date'      => ['required', 'date'],
        ]);
 
        $receivables = $request->session()->get('receivables', []);
 
        $id = time(); // simple unique ID using the current timestamp
 
        $receivables[$id] = [
            'id'            => $id,
            'customer_name' => $request->customer_name,
            'reference_no'  => $request->reference_no,
            'amount'        => $request->amount,
            'due_date'      => $request->due_date,
            'status'        => 'pending',
            'paid_at'       => null,
        ];
 
        $request->session()->put('receivables', $receivables);
 
        return back()->with('success', 'Payment record added.');
    }
 
    /**
     * Mark a payment as received.
     */
    public function markPaid(Request $request, $id)
    {
        $receivables = $request->session()->get('receivables', []);
 
        if (isset($receivables[$id])) {
            $receivables[$id]['status']  = 'paid';
            $receivables[$id]['paid_at'] = now()->toDateTimeString();
        }
 
        $request->session()->put('receivables', $receivables);
 
        return back()->with('success', 'Payment marked as received.');
    }
}