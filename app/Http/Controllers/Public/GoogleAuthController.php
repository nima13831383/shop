<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['google' => 'Google login failed']);
        }

        // پیدا کردن یا ایجاد کاربر
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name'              => $googleUser->getName(),
                'google_id'         => $googleUser->getId(),
                'password'          => bcrypt(str()->random(20)), // جلوگیری از خطا
                'email_verified_at' => now(),
            ]
        );


        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
