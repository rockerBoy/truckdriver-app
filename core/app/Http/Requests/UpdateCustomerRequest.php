<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CustomerRequest extends FormRequest
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
    public function rules()
    {
        if ($this->uuid) {
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

        return [
            'first_name'            => ['required'],
            'first_name_en'         => ['required'],
            'last_name'             => ['required'],
            'last_name_en'          => ['required'],
            'patronymic'            => ['required'],
            'email'                 => ['nullable'],
            'phone_messengers'      => ['nullable'],
            'phone_number'          => ['required', 'unique:customers,phone_number'],
            'phone_number_alt'      => ['nullable'],
            'phone_alt_messengers'  => ['nullable'],
            'birth_date'            => ['required', 'date_format:Y-m-d'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            [
                'birth_date' => Carbon::createFromFormat('d.m.Y', $this->birth_date)->format('Y-m-d'),
                'phone_number' => $this->phone_number,
                'phone_messengers' => json_encode($this->phone_messengers),
                'phone_alt_messengers' => json_encode($this->phone_alt_messengers),
                'phone_number_alt' => $this->phone_number_alt,
            ]
        );
    }
}
