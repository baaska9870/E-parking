<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('welcome');
        }
        return view('login_page');
    }

    /**
     * Handle user login.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'email.required' => 'Email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.exists' => 'This email is not registered.',
            'password.required' => 'Password field is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('welcome')->with('success', 'Login successful!');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['password' => 'The provided credentials do not match our records.']);
    }

    /**
     * Show the signup form.
     *
     * @return \Illuminate\View\View
     */
    public function showSignupForm()
    {
        if (Auth::check()) {
            return redirect()->route('welcome');
        }
        return view('login_page');
    }

    /**
     * Handle user registration/signup.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:admin,user'],
        ], [
            'name.required' => 'Name field is required.',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name must not exceed 255 characters.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'role.required' => 'Role selection is required.',
            'role.in' => 'Selected role is invalid.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('welcome')->with('success', 'Account created and logged in!');
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }

    /**
     * Show the dashboard (protected route).
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }
}
