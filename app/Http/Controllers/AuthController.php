<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
            $validator = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2, //user
            ]);

            return redirect()->route('login');

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['message' => 'Email or password is wrong.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showUserLoginForm()
    {
        return view('auth.user-login');
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();
        $credentials['role_id'] = '2';
        if ($user && $user->is_blocked == 1) {
            return redirect()->back()->withErrors(['message' => 'Your account is blocked. Please contact support.']);
        }

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['message' => 'Email or password is wrong.']);
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role_id'] = '1';
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['message' => 'Email or password is wrong.']);
    }
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('message', 'Logged out successfully!');
    }


}


