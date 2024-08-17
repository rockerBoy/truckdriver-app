<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'customer_uuid'       => ['nullable'],
            'country'             => ['nullable'],
            'region'              => ['nullable'],
            'city'                => ['nullable'],
            'district'            => ['nullable'],
            'street'              => ['nullable'],
            'building'            => ['nullable'],
            'house'               => ['nullable'],
            'apartment'           => ['nullable'],
            'zip'                 => ['nullable'],
            'additional_zip'      => ['nullable'],
            'has_additional_zip'  => ['boolean'],
        ];
    }
}
