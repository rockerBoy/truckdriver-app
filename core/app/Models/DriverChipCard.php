<?php

namespace App\Models\Driver;

use App\Models\DriverLicense;
use App\Traits\UUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverChipCard extends Model
{
    use HasFactory, UUID;

    public $incrementing = false;

    protected $fillable = [
        'customer_uuid',
        'card_serial',
        'exchange_reason',
        'expiration_date',
    ];

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $table = 'driver_chip_card';

    public function license(): BelongsTo
    {
        return $this->belongsTo(DriverLicense::class, 'customer_uuid', 'customer_uuid');
    }

    /**
     * @return Attribute
     */
    protected function expirationDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d', $value)
                                     ->format('d.m.Y'),
            set: fn ($value) => Carbon::parse($value)
                                     ->format('Y-m-d'),
        );
    }
}
