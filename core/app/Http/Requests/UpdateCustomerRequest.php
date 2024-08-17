<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;

class UpdateCustomerRequest extends CreateCustomerRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'first_name' => 'string[]',
        'first_name_en' => 'string[]',
        'last_name'  => 'string[]',
        'last_name_en' => 'string[]',
        'patronymic' => 'string[]',
        'phone_number' => 'string[]',
        'phone_messengers' => 'string[]',
        'phone_number_alt' => 'string[]',
        'phone_alt_messengers' => 'string[]',
        'birth_date' => 'string[]',
        'email'      => 'string[]',
    ])]
    public function rules(): array
    {
        return [
            'first_name'    => ['required'],
            'first_name_en' => ['required'],
            'last_name'     => ['required'],
            'last_name_en'  => ['required'],
            'patronymic'    => ['required'],
            'email'         => ['nullable'],
            'phone_number'  => ['required', 'unique:customers,phone_number,' . $this->uuid . ',uuid'],
            'phone_number_alt'  => ['nullable', 'unique:customers,phone_number_alt,' . $this->uuid . ',uuid'],
            'birth_date'    => ['required', 'date_format:Y-m-d'],
            'phone_alt_messengers'  => ['nullable'],
            'phone_messengers'      => ['nullable'],
        ];
    }
}
