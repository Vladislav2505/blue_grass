<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

final class NewsPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array|ValidationException
    {
        $this->merge(['is_active' => $this->has('is_active')]);

        $rules = [
            'name' => ['required', 'string', 'max:80'],
            'description' => ['required', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ];

        if (! $this->has('loadedImages')) {
            $rules['image'] = ['nullable', 'image', 'extensions:png,jpg,jpeg', 'max:10240'];
        }

        return $rules;
    }
}
