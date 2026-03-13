<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }



    public function login(Request $request)
{
    // Step 1: Validate request
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
        'role'     => 'required|string'
    ]);

    // Step 2: Find user by email
    $admin = Admin::where('email', $request->email)->first();
    

    // Step 3: Check if admin exists and password is valid
    if ($admin && password_verify($request->password, $admin->password)) {

        // Step 4: Check if role matches
        if ($admin->role !== $request->role) {
            return response()->json([
                'status' => false,
                'msg'    => 'Role does not match.'
            ]);
        }

        // Step 5: Login the admin
        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();

        return response()->json([
            'status'   => true,
            'msg'      => 'Login successful!',
            'location' => url('admin/dashboard')
        ]);
    }

    // Step 6: Invalid credentials
    return response()->json([
        'status' => false,
        'msg'    => 'Email or password is incorrect.'
    ]);
}




    /**
     * Logout the admin
     */
    public function logout(Request $request)
{
    // Logout admin guard
    Auth::guard('admin')->logout();

    // Invalidate session
    $request->session()->invalidate();

    // Regenerate CSRF token
    $request->session()->regenerateToken();

    // Redirect to admin login page
    return redirect()->route('admin.login')->with('status', 'Logged out successfully.');
}

}
