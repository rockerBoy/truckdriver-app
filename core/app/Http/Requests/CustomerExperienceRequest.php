<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerExperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        if ($this->uuid) {
            return [
                'customer_uuid' => ['required', 'unique:App\Models\CustomerExperience,customer_uuid,' . $this->uuid . ',uuid'],
                'general_exp' => ['required', 'string'],
                'work_places' => ['required', 'string'],
                'trailers' => ['nullable', 'array'],
            ];
        }

        return [
            'customer_uuid' => ['required', 'unique:App\Models\CustomerExperience,customer_uuid'],
            'general_exp' => ['required', 'string'],
            'work_places' => ['required', 'string'],
            'trailers' => ['nullable', 'array'],
        ];
    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'work_places' => json_encode($this->work_places, JSON_THROW_ON_ERROR),
        ]);
    }
}
