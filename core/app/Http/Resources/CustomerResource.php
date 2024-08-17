<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

final class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'phone_number_alt' => $this->phone_number_alt,
            'phone_messengers' => $this->phone_messengers,
            'phone_alt_messengers' => $this->phone_alt_messengers,
            'first_name' => $this->first_name,
            'first_name_en' => $this->first_name_en,
            'last_name' => $this->last_name,
            'last_name_en' => $this->last_name_en,
            'patronymic' => $this->patronymic,
            'birth_date' => Carbon::make($this->birth_date)?->format('d.m.Y'),
        ];
    }
}
