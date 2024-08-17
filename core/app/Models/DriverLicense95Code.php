<?php

namespace App\Models\Driver;

use App\Models\DriverLicense;
use App\Traits\UUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DriverLicense95Code extends Model
{
    use HasFactory, UUID;

    public $incrementing = false;

    protected $fillable = [
        'driver_license_uuid',
        '95_code_region',
        'expiration_date',
    ];

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $table = 'driver_license_95_code';

    /**
     * @return BelongsToMany
     */
    public function licenses(): BelongsToMany
    {
        return $this->belongsToMany(DriverLicense::class, 'driver_license_95_code', 'driver_license_uuid', '');
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
