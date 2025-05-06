<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ReCaptchaService
{
    public function verify(?string $token): bool
    {
        if (empty($token)) {
            return false;
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recaptcha.secret_key'),
            'response' => $token,
        ]);

        return $response->json('success', false);
    }
}
