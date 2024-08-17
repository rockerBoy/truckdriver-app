<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverChipCardRequest extends FormRequest
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
        if ($this->uuid) {
            return [
                'customer_uuid' => ['required', 'unique:App\Models\DriverLicense,customer_uuid,' . $this->uuid . ',uuid'],
                'card_serial' => ['required', 'unique:App\Models\DriverChipCard,card_serial,' . $this->card_serial . ',card_serial'],
                'exchange_reason' => ['nullable'],
                'expiration_date' => ['required'],
            ];
        }

        return [
            'customer_uuid' => ['required', 'unique:App\Models\DriverLicense,customer_uuid'],
            'card_serial' => ['required', 'unique:App\Models\DriverChipCard,card_serial'],
            'exchange_reason' => ['nullable'],
            'expiration_date' => ['required'],
        ];
    }
}
