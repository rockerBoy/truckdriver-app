<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerAdditionalInformation extends Model
{
    use HasFactory;

    /**
     * @var array[]
     */
    public $fillable = [
        'customer_uuid',
        'is_sick',
        'has_entry_ban',
        'issues_description',
        'know_foreign_language',
        'certificates',
        'notes',
    ];

    protected $table = 'customer_additional_information';

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * DriverLicense -> DrivingLicenseCategory relation.
     *
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(CustomerLanguage::class, 'customer_uuid', 'customer_uuid');
    }

    /**
     * @return HasMany
     */
    public function countries(): HasMany
    {
        return $this->hasMany(CustomerCountryRestriction::class, 'customer_uuid', 'customer_uuid');
    }

    protected function certificates(): Attribute
    {
        return Attribute::make(
            get: fn ($val) => json_decode($val, true),
            set: fn ($val) => json_encode($val),
        );
    }
}
