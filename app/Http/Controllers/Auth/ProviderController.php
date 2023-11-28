<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Notifications\UserFollowNotification;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Notification;
class ProviderController extends Controller
{

    public function redirectProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback(Request $request)
    {
        try {
        $user = Socialite::driver('google')->user();

        }catch (\Exception $e) {
            return redirect('/login');

        }

        $existingUser = User::where('provider_id', $user->id)->first();

        if($existingUser){
            Auth::login($existingUser, true);

             if($existingUser->hasRole('New User')){
                flash()->addSuccess('Account Registered.');
                return redirect()->to(route('auth.welcome-user'));
            }else{
                flash()->addInfo('Welcome to UniCESS.');
                return redirect()->to(route('lnu'));
            }

        }else{

            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            ]);

            $user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider_id' =>  $user->id,
                'provider' => 'google',
                'provider_token' => $user->token,


            ]);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();



            if($user->hasRole('Faculty extensionist')){
                ($user->removeRole('Faculty extensionist'));
            }elseif($user->hasRole('admin')){
                $user->removeRole('admin');
            }

            $user->assignRole('New User');

            Auth::login($user, true);

            $admin = User::whereHas('roles', function ($query) { $query->where('id', 1); })->get();

            Notification::send($admin, new UserFollowNotification($user));

        }

        if($user->hasRole('New User') || $existingUser->hasRole('New User')){
            flash()->addSuccess('Account Registered.');
            return redirect()->to(route('auth.welcome-user'));
        }
        else {
            flash()->addInfo('Welcome to UniCESS.');
            return redirect()->to(route('lnu'));
        }
    }
}
