<?php

namespace App\Http\Controllers;

use Redirect;
use Socialite;
use App\User;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();

        $user = $this->createUser($getInfo, $provider);

        auth()->login($user);

        return redirect()->to('/');
    }

    public function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            $user = new User([
                'provider_name' => $provider,
                'provider_id' => $getInfo->id,
                'name' => $getInfo->name,
                'email' => $getInfo->email,
            ]);

            $user->save();
        }

        return $user;
    }
}
