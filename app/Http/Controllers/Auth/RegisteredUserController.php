<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255', // New rule for surname
            'nickname' => 'required|string|max:255', // New rule for nickname
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => 'required|string|max:255', // New rule for address
            'postal_code' => 'required|string|max:10', // New rule for postal_code
            'city' => 'required|string|max:255', // New rule for city
            'profile_picture' => 'nullable|image|max:2048', // Validates that it's an image and limited to 2MB.
            'description' => 'nullable|string|max:300',     // Validates that it's a string and limited to 300 characters.
            'phone' => 'nullable|regex:/^(\+33|0)[1-9](\d{2}){4}$/i', // Validates French phone numbers.
            'gender' => 'nullable|in:Male,Female,Other',    // Ensures gender is one of the specified values.
        ]);        

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname, // Save surname to the database
            'nickname' => $request->nickname, // Save nickname to the database
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address, // Save address to the database
            'postal_code' => $request->postal_code, // Save postal_code to the database
            'city' => $request->city, // Save city to the database
            'description' => $request->description,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);        

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
