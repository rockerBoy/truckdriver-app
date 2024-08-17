<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DrivingLicenseCategory extends Pivot
{
    use HasFactory;
    use UUID;

    public $incrementing = false;

    protected $fillable = [
        'card_uuid',
        'category',
    ];

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $table = 'driver_license_category';

    public function card()
    {
        $this->belongsTo(DriverLicense::class, 'uuid', 'card_uuid');
    }
}
