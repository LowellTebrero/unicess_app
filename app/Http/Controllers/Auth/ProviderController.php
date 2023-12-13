<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Events\RealtimeNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserFollowNotification;

class ProviderController extends Controller
{

    public function redirectProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {

        try {
        $user = Socialite::driver('google')->user();

        }catch (\Exception $e) {
            return redirect('/login');

        }


        $existingUser = User::where('provider_id', $user->id)->first();
        $existingEmail = User::where('email', $user->email)->first();

        if($existingUser){
            Auth::login($existingUser, true);

             if($existingUser->hasRole('New User')){
                flash()->addSuccess('Account Registered.');
                return redirect()->to(route('auth.welcome-user'));
            }else{
                flash()->addInfo('Welcome to UniCESS.');
                return redirect()->to(route('lnu'));
            }

        }elseif($existingEmail){

            $validator = Validator::make([], []); // Empty validator
            $validator->errors()->add('email', 'Email already exists'); // Add an error message

            return redirect('/login')->withErrors($validator)->withInput();
        }else{




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

            // broadcast(new RealtimeNotification(['message' => 'New user registered!', 'user_id' => $user->id]));
            // event(new RealtimeNotification('hello world'));
            event(new RealtimeNotification('New account registered!', $user->id ,$user->email, $user->created_at->diffForHumans() ));

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
