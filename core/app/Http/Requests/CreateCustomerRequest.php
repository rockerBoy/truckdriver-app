<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    protected const array CUSTOMER_RULES = [
        'first_name'           => ['required'],
        'first_name_en'        => ['required'],
        'last_name'            => ['required'],
        'last_name_en'         => ['required'],
        'patronymic'           => ['required'],
        'email'                => ['nullable'],
        'phone_messengers'     => ['nullable'],
        'phone_number'         => ['required', 'unique:customers,phone_number'],
        'phone_number_alt'     => ['nullable'],
        'phone_alt_messengers' => ['nullable'],
        'birth_date'           => ['required', 'date_format:Y-m-d'],
    ];

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
        return self::CUSTOMER_RULES;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            [
                'birth_date'           => Carbon::createFromFormat('d.m.Y', $this->birth_date)->format('Y-m-d'),
                'phone_number'         => $this->phone_number,
                'phone_messengers'     => json_encode($this->phone_messengers),
                'phone_alt_messengers' => json_encode($this->phone_alt_messengers),
                'phone_number_alt'     => $this->phone_number_alt,
            ]
        );
    }
}
