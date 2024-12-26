<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'], // Check if the email is unique in the users table
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $employerAttributes = $request->validate([
            'employer' => ['required'],
            'logo' => ['required', File::types(['png', 'jpg', 'webp'])],
        ]);

        // Create user
        $user = User::create($userAttributes);

        $logoPath = $request->logo->store('logos'); // Go to 'config' directory and check 'filesystems.php' file to see the default disk. The default disk is 'local' and the root is 'storage_path('app')'. So, the file will be stored in 'storage/app/logos' directory.

        $user->employer()->create([
            'name' => $employerAttributes['employer'],
            'logo' => $logoPath,
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to the home page
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
