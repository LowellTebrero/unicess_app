<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Faculty;
use Illuminate\View\View;
use App\Models\FacultyUser;
use App\Models\UserFaculty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

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

            'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        if($user->hasRole('Faculty extensionist')){
            ($user->removeRole('Faculty extensionist'));
        }elseif($user->hasRole('admin')){
            $user->removeRole('admin');
        }elseif($user->hasRole('Coordinator extension')){
            $user->removeRole('Coordinator extension');
        }
        $user->assignRole('New User');



        $user->sendEmailVerificationNotification();

        event(new Registered($user));

        Auth::login($user);


        // return redirect(RouteServiceProvider::HOME);
        return redirect()->to(route('auth.welcome-user'));

    }
}
