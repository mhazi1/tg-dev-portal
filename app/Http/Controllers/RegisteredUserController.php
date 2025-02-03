<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\NewUserVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::latest()->paginate(10);
        return view('auth.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $attributes = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'role' => ['required', Rule::in(['support', 'developer', 'admin'])],
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => null,
            'email_verified_at' => null,
        ]);

        $user->assignRole($attributes['role']);

        // Generate verification token
        $token = Password::createToken($user);

        Mail::to($user->email)->send(new NewUserVerification($user, $token));

        return redirect()->route('users')->with('success', 'User has been successfully registered!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::where('id', $id)->first();
        return view('auth.update', ['user' => $user]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $request->validate([
            'id' => ['required']
        ]);

        $user = User::where('id', $request->id)->firstOrFail();

        $user->delete();

        return redirect()->route('users')->with('info', 'User has been successfully deleted!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //

        $attributes = $request->validate([
            'id' => ['required'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'role' => ['required', Rule::in(['support', 'developer', 'admin'])],
        ]);

        $user = User::where('id', $attributes['id']);
        $user->update(Arr::except($attributes, ['role']));
        $user->firstOrFail()->assignRole($attributes['role']);

        return redirect()->route('users')->with('info', 'User has been successfully updated!');
    }
}
