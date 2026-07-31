<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
class AuthController extends Controller
{
    
    protected array $demoUsers = [
        'admin@gmail.com' => [
            'password' => 'admin123',
            'role'     => 'admin',
            'name'     => 'Admin User',
            'initials' => 'AD',
        ],
        'manager@gmail.com' => [
            'password' => 'manager123',
            'role'     => 'manager',
            'name'     => 'Financial Manager',
            'initials' => 'FM',
        ],
        'staff@gmail.com' => [
            'password' => 'staff123',
            'role'     => 'staff',
            'name'     => 'Financial Staff',
            'initials' => 'FS',
        ],
    ];
 
    /**
     * Show the login page.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
 
    /**
     * Handle "Authenticate Credentials" submit.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        $email = $request->email;
        $password = $request->password;
 
        if (
            isset($this->demoUsers[$email]) &&
            $this->demoUsers[$email]['password'] === $password
        ) {
            $user = $this->demoUsers[$email];
 
            $request->session()->put('logged_in', true);
            $request->session()->put('user_email', $email);
            $request->session()->put('user_name', $user['name']);
            $request->session()->put('user_role', $user['role']);
            $request->session()->put('user_initials', $user['initials']);
 
            // Admin goes to the full dashboard with charts and stats.
            // Manager and Staff go straight to the Financial modules.
            if ($user['role'] === 'admin') {
                return redirect('/admin-dashboard');
            }
 
            return redirect('/dashboard');
        }
 
        return back()
            ->withErrors(['email' => 'Invalid email or password.'])
            ->onlyInput('email');
    }
 
    /**
     * "Quick Preview" — logs in as Admin automatically, no password needed.
     */
    public function quickPreview(Request $request)
    {
        $user = $this->demoUsers['admin@financial.com'];
 
        $request->session()->put('logged_in', true);
        $request->session()->put('user_email', 'admin@financial.com');
        $request->session()->put('user_name', $user['name']);
        $request->session()->put('user_role', $user['role']);
        $request->session()->put('user_initials', $user['initials']);
 
        return redirect('/admin-dashboard');
    }
 
    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
 
        return redirect('/login');
    }
}