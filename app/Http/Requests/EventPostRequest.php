<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

class EventPostRequest extends FormRequest
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
        if ($this->has('date_of') && ! is_null($this->input('date_of'))) {
            try {
                $dateTime = Carbon::createFromFormat('Y-m-d\TH:i', $this->input('date_of'))->toDateTimeString();
                $this->merge(['date_of' => $dateTime]);
            } catch (InvalidFormatException) {
                throw ValidationException::withMessages(['date_of' => 'Неправильный формат даты']);
            }
        }

        $this->merge(['is_active' => $this->has('is_active')]);
        $this->merge(['request_access' => $this->has('request_access')]);

        $rules = [
            'name' => ['required', 'string', 'max:180'],
            'date_of' => ['required', 'date_format:"Y-m-d H:i:s"'],
            'award' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:100000'],
            'request_access' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'theme_id' => ['required', 'integer', 'exists:themes,id'],
            'location_id' => ['required', 'integer', 'exists:locations,id'],
            'nominations' => ['required', 'array'],
            'nominations.*' => ['integer', 'exists:nominations,id'],
        ];

        if (! $this->has('loadedImages')) {
            $rules['image'] = ['required', 'image', File::image()->extensions(['png', 'jpg', 'jpeg'])->max(10 * 1024 * 1024)];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nominations.required' => 'Поле "Номинации" обязательно для заполнения.',
        ];
    }
}
