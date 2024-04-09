<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Stevebauman\Location\Facades\Location;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        $userIp = $request->ip();
        $location = false;

        if ($userIp !== null) {
            $location = Location::get($userIp);
        }

        $lastLoggedInAddress = $location !== false ? $location->regionName . ', ' . $location->cityName : null;


        auth()->user()->update([
            'last_logged_in' => now(),
            'ip_address' => $request->ip(),
            'last_logged_in_address' => $lastLoggedInAddress,
        ]);


        // Check if the user has the 'admin' role
        if ($user->roles->whereIn('name', ['admin', 'super-admin'])->isNotEmpty()) {
            flash()->addInfo('Welcome to UniCESS.');
            return redirect()->intended(RouteServiceProvider::ADMINDASHBOARD);
        } else {
            flash()->addInfo('Welcome to UniCESS.');
            return redirect()->intended(RouteServiceProvider::USERDASHBOARD);
        }

          // flash()->addInfo('Welcome to UniCESS.');
        // return redirect()->intended(RouteServiceProvider::HOME);
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect(route('login'));
    }
}