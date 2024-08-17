<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverLicenseRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $defaultRules = [
            'customer_uuid' => ['required', 'unique:App\Models\DriverLicense,customer_uuid'],
            'number' => ['nullable', 'unique:App\Models\DriverLicense,number'],
            'series' => ['nullable'],
            'registrator' => ['nullable'],
            'issues_date' => ['nullable'],
            'expiration_date' => ['nullable'],
            'have_adr' => ['nullable'],
            'have_95' => ['nullable'],
            'have_chip_card' => ['nullable'],
            'categories' => ['nullable'],
            'code95' => ['nullable'],
            'chip_card' => ['nullable'],
            'adrCodes' => ['nullable', 'array'],
        ];

        if (!$this->uuid) {
            return $defaultRules;
        }

        $uniqueRules = [
            'customer_uuid' => ['required', 'unique:App\Models\DriverLicense,customer_uuid,' . $this->uuid . ',uuid'],
            'number' => ['nullable', 'unique:App\Models\DriverLicense,number,' . $this->uuid . ',uuid'],
        ];

        return array_merge($defaultRules, $uniqueRules);
    }
}
