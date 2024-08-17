<?php

namespace App\Models\Driver;

use App\Models\DriverLicense;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverCardAdr extends Model
{
    use HasFactory, UUID;

    protected $table = 'driver_license_adr';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public $fillable = [
        'customer_uuid',
        'driver_license_uuid',
        'adr_code',
    ];

    public function license(): BelongsTo
    {
        return $this->belongsTo(DriverLicense::class, 'uuid', 'driver_license_uuid');
    }
}
