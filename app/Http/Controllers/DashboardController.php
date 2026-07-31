<?php
 
namespace App\Http\Controllers;
 
class DashboardController extends Controller
{
    /**
     * The sidebar menu items — slug => label.
     */
    protected array $modules = [
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
 
    /**
     * Icons shown next to each menu item.
     */
    protected array $icons = [
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
 
    /**
     * Short descriptions shown under each page title.
     */
    protected array $descriptions = [
        'general-ledger'          => 'Track journal entries and the chart of accounts.',
        'accounts-payable'        => 'Manage bills and amounts owed to suppliers.',
        'accounts-receivable'     => 'Manage invoices and amounts owed by customers.',
        'disbursement-management' => 'Process and track outgoing payments.',
        'collection-management'   => 'Track and follow up on incoming collections.',
        'budget-management'       => 'Plan and monitor departmental budgets.',
        'cash-management'         => 'Monitor cash flow and account balances.',
        'financial-reporting'     => 'Generate financial statements and analytics.',
        'tax-management'          => 'Track tax filings, dues, and compliance.',
    ];
 
    /**
     * Default dashboard page — shows the first module.
     */
    public function index()
    {
        return $this->show('general-ledger');
    }
 
    /**
     * Show a specific module page.
     */
    public function show(string $slug)
    {
        if (!array_key_exists($slug, $this->modules)) {
            abort(404);
        }
 
        return view('dashboard', [
            'title'        => $this->modules[$slug],
            'currentSlug'  => $slug,
            'modules'      => $this->modules,
            'icons'        => $this->icons,
            'descriptions' => $this->descriptions,
        ]);
    }
}