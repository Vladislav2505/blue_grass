<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Translation\PotentiallyTranslatedString;
use JsonException;

class RecaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     *
     * @throws JsonException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $gResponseToken = (string) $value;
        $response = Http::asForm()
            ->post('https://www.google.com/recaptcha/api/siteverify', ['secret' => config('services.recaptcha.secret'), 'response' => $gResponseToken]);

        if (! json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR)['success']) {
            $fail(__('Капча провалена.'));
        }
    }
}
