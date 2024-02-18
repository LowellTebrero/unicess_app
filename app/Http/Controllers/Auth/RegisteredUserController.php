<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Stevebauman\Location\Facades\Location;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[^\s]+$/', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $userIp = $request->ip();
        $location = false;

        if ($userIp !== null) {
            $location = Location::get($userIp);
        }

        $lastLoggedInAddress = $location !== false ? $location->regionName . ', ' . $location->cityName : null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ip_address' => $request->ip(),
            'last_logged_in' => now(),
            'last_logged_in_address' => $lastLoggedInAddress,
        ]);


        $user->assignRole('New User');


        $user->sendEmailVerificationNotification();

        event(new Registered($user));

        Auth::login($user);


        // return redirect(RouteServiceProvider::HOME);
        return redirect()->to(route('auth.welcome-user'));

    }
}
