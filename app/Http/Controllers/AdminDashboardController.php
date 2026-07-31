<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Must be logged in
        if (!$request->session()->get('logged_in')) {
            return redirect('/login');
        }
 
        // Only Admin can view this page
        if ($request->session()->get('user_role') !== 'admin') {
            return redirect('/dashboard');
        }
 
        $stats = [
            'total_revenue'   => 1250000.00,
            'revenue_change'  => 12.5,
            'total_expenses'  => 820000.00,
            'expenses_change' => 8.3,
            'net_profit'      => 430000.00,
            'profit_change'   => 15.7,
            'cash_balance'    => 670000.00,
            'cash_change'     => 5.4,
            'total_users'     => 12,
            'new_users'       => 2,
            'active_users'    => 9,
            'pending_tasks'   => 5,
        ];
 
        $activities = [
            [
                'icon'     => '👤',
                'title'    => 'New user added',
                'subtitle' => 'Finance Staff - Juan Dela Cruz',
                'time'     => '10 minutes ago',
            ],
            [
                'icon'     => '📋',
                'title'    => 'Financial report generated',
                'subtitle' => 'Income Statement - May 2024',
                'time'     => '1 hour ago',
            ],
            [
                'icon'     => '⚙️',
                'title'    => 'System settings updated',
                'subtitle' => 'General Configuration',
                'time'     => '3 hours ago',
            ],
            [
                'icon'     => '🔄',
                'title'    => 'User role changed',
                'subtitle' => 'Finance Staff - Maria Santos',
                'time'     => '5 hours ago',
            ],
        ];
 
        $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $chartValues = [250000, 450000, 500000, 700000, 1020000, 780000, 800000, 810000, 950000, 1000000, 1300000, 1150000];
 
        return view('admin-dashboard', [
            'stats'       => $stats,
            'activities'  => $activities,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
        ]);
    }
}