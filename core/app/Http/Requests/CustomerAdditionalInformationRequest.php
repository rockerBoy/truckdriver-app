<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAdditionalInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $defaultRules = [
            'customer_uuid' => ['required', 'unique:App\Models\CustomerAdditionalInformation,customer_uuid'],
            'is_sick' => ['required', 'boolean'],
            'issues_description' => ['nullable'],
            'has_entry_ban' => ['required', 'boolean'],
            'know_foreign_language' => ['required', 'boolean'],
            'certificates' => ['nullable', 'array'],
            'restrictions' => ['nullable', 'array'],
            'language_levels' => ['nullable'],
            'notes' => ['nullable'],
        ];

        if ($this->id) {
            $defaultRules['customer_uuid'] = ['required', 'unique:App\Models\CustomerAdditionalInformation,customer_uuid,' . $this->id . ',id'];

            return $defaultRules;
        }

        return $defaultRules;
    }
}
