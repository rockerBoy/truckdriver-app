<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerCountryRestriction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_uuid',
        'country_id',
        'ban_expiration_date',
    ];

    public function additionalInfo(): BelongsTo
    {
        return $this->belongsTo(CustomerAdditionalInformation::class, 'customer_uuid', 'customer_uuid');
    }

    protected function banExpirationDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d.m.Y'),
            set: fn ($value) => Carbon::createFromFormat('d.m.Y', $value)
                       ->format('Y-m-d')
        );
    }
}
