<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->loginOrRegister($user, 'google');

        return redirect('/dashboard');
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->loginOrRegister($user, 'facebook');

        return redirect('/dashboard');
    }
    private function loginOrRegister($socialUser, $provider)
    {
        $email = $socialUser->getEmail() ?: $this->createFallbackEmail($socialUser, $provider);

        $user = User::where('email', $socialUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $email,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => bcrypt(Str::random(16)),
                'role' => 'customer',
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now()
            ]);
        } else {
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);
        }

        Auth::login($user, true);
    }

    private function createFallbackEmail($socialUser, $provider)
    {
        return Str::lower($socialUser->getName()) . '_' . $socialUser->getId() . '@' . $provider . '.com';
    }
}
