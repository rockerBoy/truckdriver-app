<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class DriverLicense95CodeRequest extends FormRequest
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
        return [
            'driver_license_uuid' => ['required'],
            '95_code_region'  => ['required'],
            'expiration_date'  => ['required'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            [
                'expiration_date' => Carbon::createFromFormat('d.m.Y', $this->expiration_date)->format('Y-m-d'),
            ]
        );
    }
}
