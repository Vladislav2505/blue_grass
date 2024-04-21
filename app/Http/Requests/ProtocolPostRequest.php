<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

class ProtocolPostRequest extends FormRequest
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
        $this->merge(['is_downloadable' => $this->has('is_downloadable')]);
        $this->merge(['is_active' => $this->has('is_active')]);

        $rules = [
            'name' => ['required', 'string', 'max:80'],
            'date' => ['nullable', 'date_format:Y-m-d'],
            'is_downloadable' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];

        if ($this->post('loadedFile') === null) {
            $rules['file'] = ['required', File::default()
                ->extensions(['docx', 'doc', 'pdf'])
                ->max(10 * 1024 * 1024)];
        }

        return $rules;
    }
}
