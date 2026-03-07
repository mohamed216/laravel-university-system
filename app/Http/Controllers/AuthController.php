<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\Activity;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Log login activity
            Activity::logLogin($user);
            
            // Check if email is verified (optional - can be enforced)
            // if (!$user->hasVerifiedEmail()) {
            //     return redirect()->route('verification.notice');
            // }
            
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'professor') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Log logout activity before logging out
        if (Auth::check()) {
            Activity::logLogout(Auth::user());
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Security: Only allow student registration through public form
        // Professors and admins must be created by admins
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
        ]);

        // Send email verification notification
        // $user->sendEmailVerificationNotification();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Show email verification notice
     */
    public function showVerificationNotice()
    {
        return view('auth.verify-email');
    }

    /**
     * Verify user email
     */
    public function verifyEmail(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return redirect('/')->with('error', 'User not found');
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect('/')->with('error', 'Invalid verification link');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/dashboard')->with('message', 'Email already verified');
        }

        if ($user->markEmailAsVerified()) {
            // Event fired when email is verified
            // event(new Verified($user));
        }

        return redirect('/dashboard')->with('message', 'Email verified successfully');
    }

    /**
     * Resend verification email
     */
    public function resendVerificationEmail(Request $request)
    {
        $user = User::find($request->user()->id);

        if ($user->hasVerifiedEmail()) {
            return redirect('/dashboard')->with('message', 'Email already verified');
        }

        // $user->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    /**
     * Get authenticated user (for API)
     */
    public function user(Request $request)
    {
        return $request->user();
    }
}
