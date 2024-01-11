<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        dd($request);
         // Check if the user has already verified their email
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

         // Send a new email verification notification
        $request->user()->sendEmailVerificationNotification();

         // Redirect back with a status message
        return back()->with('status', 'verification-link-sent');
    }
}
