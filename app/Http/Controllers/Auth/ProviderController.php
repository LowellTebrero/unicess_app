<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

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
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider_id' =>  $user->id,
                'provider' => 'google',
                'provider_token' => $user->token,


            ]);
            $newUser->email_verified_at = date('Y-m-d H:i:s');
            $newUser->save();



            if($newUser->hasRole('Faculty extensionist')){
                ($newUser->removeRole('Faculty extensionist'));
            }elseif($newUser->hasRole('admin')){
                $newUser->removeRole('admin');
            }

            $newUser->assignRole('New User');

            Auth::login($newUser, true);

        }

        if($newUser->hasRole('New User') || $existingUser->hasRole('New User')){
            flash()->addSuccess('Account Registered.');
            return redirect()->to(route('auth.welcome-user'));
        }
        else {
            flash()->addInfo('Welcome to UniCESS.');
            return redirect()->to(route('lnu'));
        }
    }
}
