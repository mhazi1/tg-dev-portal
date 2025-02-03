<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class SetPasswordController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create($token, Request $request)
    {

        return view('password.create', [
            'token' => $token,
            'email' => $request->query('email')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd([
        //     'submitted_token' => $request->token,
        //     'email' => $request->email,
        //     'db_token' => DB::table('password_reset_tokens')
        //         ->where('email', $request->email)
        //         ->first()
        // ]);
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $credentials = [
            'email' => $request->email,
            'token' => $request->token,  // Password broker will hash this internally
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ];

        // Verify token
        $status = Password::reset(
            $credentials,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'password_set' => true,
                    'email_verified_at' => now(),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Add this debug line
        // dd([
        //     'status' => $status,
        //     'password_reset_constant' => Password::PASSWORD_RESET,
        //     'are_they_equal' => $status === Password::PASSWORD_RESET
        // ]);

        // Log::info('Password reset status', ['status' => $status]);

        // if ($status === Password::PASSWORD_RESET) {
        //     return redirect()->route('login')
        //         ->with('success', 'Your password has been set. You can now login.');
        // }

        if ($status == Password::PASSWORD_RESET) {
            // Add some debugging

            return redirect()->route('login')
                ->with('success', 'Your password has been set. You can now login.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }

    public function show()
    {
        return view('password.email');
    }

    public function email(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email could not be found.');
        }

        if (!$user->password_set) {
            return redirect()->back()->with('error', 'Password has not yet been set. Please ask the administrator to resend the email verification link.');
        }

        // Generate verification token
        $token = Password::createToken($user);

        Mail::to($user->email)->send(new ResetPassword($user, $token));

        return back()->with('success', 'Email to reset password has been successfully sent! Please check your inbox.');
    }


    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('success', 'Password has been successfully reset! You may login now.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
