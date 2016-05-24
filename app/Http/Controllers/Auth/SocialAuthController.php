<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use TrafficBow\User;
use App\Http\Requests;
use Socialite;

class SocialAuthController extends Controller
{

    public function loginWithFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebookCallback()
    {
        $providerUser = Socialite::driver('facebook')->user();
        $user = User::whereEmail($providerUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook',
            ]);
        }

        auth()->login($user);

        return redirect()->to('/videos/create');
    }

}
