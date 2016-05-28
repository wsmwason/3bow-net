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

    public function loginWithFacebookCallback(Request $request)
    {
        try {
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

            if ($request->session()->get('referer')) {
                $refererUrl = $request->session()->get('referer');
                if (strpos($refererUrl, 'login') === false) {
                    $request->session()->forget('referer');
                    return redirect($refererUrl);
                }
            }

            return redirect('/videos/create');
        } catch (\Exception $ex) {
            return redirect()->to('/');
        }
    }

}
