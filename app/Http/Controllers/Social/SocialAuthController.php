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
    public function redirectToProvider($provider)
    {
        $this->validateProvider($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $this->validateProvider($provider);

        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Unable to login, please try again.');
        }

        if (!$user->getEmail() && !$user->getName()) {
            return redirect('/login')->withErrors('Missing required user information.');
        }

        $this->loginOrRegister($user, $provider);

        return redirect('/dashboard');
    }

    private function loginOrRegister($socialUser, $provider)
    {
        $email = $socialUser->getEmail() ?: $this->createFallbackEmail($socialUser, $provider);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect('/login')->withErrors('Invalid email format.');
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $socialUser->getName(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => bcrypt(Str::random(16)),
                'role' => 'customer',
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user, true);

        return redirect('/dashboard');
    }

    private function createFallbackEmail($socialUser, $provider)
    {
        return Str::lower($socialUser->getName()) . '_' . $socialUser->getId() . '@' . $provider . '.com';
    }

    private function validateProvider($provider)
    {
        $supportedProviders = ['google', 'facebook'];
        if (!in_array($provider, $supportedProviders)) {
            abort(404, 'Unsupported provider');
        }
    }
}
