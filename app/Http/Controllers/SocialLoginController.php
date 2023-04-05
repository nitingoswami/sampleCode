<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialLoginController extends Controller
{
    public function linkedinRedirect($provider)
    {
      return Socialite::driver($provider)->redirect();
    //    $user = Socialite::driver('linkedin')->user();
    //    return response()->json($user);
    }

    public function linkedinCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->user();

            $linkedinUser = User::where('email', $user->email)->first();

            if($linkedinUser){

                Auth::login($linkedinUser);

                return redirect('/');

            }else{
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id' => $user->id,
                    'oauth_type' => $provider,
                    'password' => encrypt('password')
                ]);

                Auth::login($user);

                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
