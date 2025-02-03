<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    /**
     * Show the user profile
     */

    public function show()
    {
        $user = Auth::user();

        return view('auth.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $attributes = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required']
        // ]);

        // $user = User::where('email', $request->email)->first();

        // // If user doesn't exist, throw validation error
        // if (!$user) {
        //     throw ValidationException::withMessages([
        //         'email' => 'Sorry, we could not find an account with that email.',
        //     ]);
        // }

        // // Check if password has been set
        // if (!$user->password_set) {
        //     return back()
        //         ->with('error', 'Your password has not been set. Please contact your administrator to resend the verification email.');
        // }

        // // Check for user role
        // if ($user->getRoleNames()->isEmpty()) {
        //     return back()
        //         ->with('error', 'Your account does not have any assigned roles. Please contact the administrator.');
        // }


        // if (! Auth::attempt($attributes)) {
        //     # code...
        //     throw ValidationException::withMessages([
        //         'email' => 'Sorry those credentials do not match.',
        //         'password' => 'Sorry those credentials do not match.'
        //     ]);
        // }

        // request()->session()->regenerate();

        // return redirect('/dashboard');

        // Validate the request
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        // Find the user
        $user = User::where('email', $request->email)->first();

        // Check if user exists
        if (!$user) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'We could not find an account with that email address.'
                ]);
        }

        // Check if password has been set
        if (!$user->password_set) {
            return back()
                ->withInput()
                ->with('error', 'Your password has not been set. Please contact your administrator to resend the verification email.');
        }

        // Check for user role
        if ($user->getRoleNames()->isEmpty()) {
            return back()
                ->withInput()
                ->with('error', 'Your account does not have any assigned roles. Please contact the administrator.');
        }

        // Attempt authentication
        if (!Auth::attempt($attributes)) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'The provided credentials do not match our records.'
                ]);
        }

        // Successful login
        $request->session()->regenerate();


        // Redirect to intended page or dashboard
        return redirect()->intended(route('dashboard'))
            ->with('success', 'Successfully logged in!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        //
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Successfully logged out!');;
    }

    public function dashboard()
    {
        $activeCertificates = Certificate::where('status', 'active')->count();
        $expiringSoon = Certificate::where('expiry_date', '<=', Carbon::now()->addDays(30))
            ->where('expiry_date', '>', Carbon::now()) // Ensure it's still active
            ->count();
        $verifiedClients = Client::where('verified', true)->count();

        // dd($verifiedClients);

        $certs = Certificate::latest()->paginate(8);
        return view('index', compact('activeCertificates', 'expiringSoon', 'verifiedClients', 'certs'));
    }
}
