<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PassportRequest extends FormRequest
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
                'customer_uuid'     => ['required'],
                'passport_series'   => ['max:2'],
                'passport_number'   => ['required', 'unique:App\Models\Passport,passport_number,' . $this->uuid . ',uuid', 'max:13'],
                'martial_status'    => ['required'],
                'issues_date'       => ['required', 'date_format:Y-m-d'],
                'registrator'       => ['required'],
                'registration_date' => ['required', 'date_format:Y-m-d'],
                'country'           => ['required'],
            ];
        }

        return [
            'customer_uuid'     => ['required'],
            'passport_series'   => ['max:2'],
            'passport_number'   => ['required', 'unique:App\Models\Passport,passport_number', 'max:13'],
            'martial_status'    => ['required'],
            'registrator'       => ['required'],
            'country'           => ['required'],
            'issues_date'       => ['nullable', 'date_format:Y-m-d'],
            'registration_date' => ['nullable', 'date_format:Y-m-d'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $mergeData = [];

        if (!empty($this->issues_date)) {
            $mergeData['issues_date'] = Carbon::createFromFormat('d.m.Y', $this->issues_date)
                                              ->format('Y-m-d');
        }

        if (!empty($this->registration_date)) {
            $mergeData['registration_date'] = Carbon::createFromFormat('d.m.Y', $this->registration_date)
                                              ->format('Y-m-d');
        }

        if (!empty($mergeData)) {
            $this->merge($mergeData);
        }
    }
}
