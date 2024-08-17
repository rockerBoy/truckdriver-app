<?php

namespace App\Models;

use App\Models\Driver\DriverCardAdr;
use App\Models\Driver\DriverChipCard;
use App\Models\Driver\DriverLicense95Code;
use App\Traits\UUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use ParagonIE\CipherSweet\EncryptedRow;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;

class DriverLicense extends Model implements CipherSweetEncrypted
{
    use HasFactory, UUID;
    use UsesCipherSweet;

    public $fillable = [
        'customer_uuid',
        'number',
        'series',
        'registrator',
        'issues_date',
        'expiration_date',
        'have_adr',
        'have_95',
        'have_chip_card',
    ];

    public $incrementing = false;

    public $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $table = 'driver_license';

    /**
     * @return Attribute
     */
    protected function issuesDate(): Attribute
    {
        $defaultDate = '0000-00-00';

        return Attribute::make(
            set: fn ($value) => $value ? Carbon::createFromFormat('d.m.Y', $value)
                ->format('Y-m-d') : null
        );
    }

    /**
     * @return Attribute
     */
    protected function expirationDate(): Attribute
    {
        $defaultDate = '0000-00-00';

        return Attribute::make(
            set: fn ($value) => $value ? Carbon::createFromFormat('d.m.Y', $value)
                ->format('Y-m-d') : null
        );
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * DriverLicense -> DrivingLicenseCategory relation.
     *
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(DrivingLicenseCategory::class, 'card_uuid', 'uuid');
    }

    /**
     * DriverLicense -> DriverLicenseAdr relation.
     *
     * @return HasMany
     */
    public function adrs(): HasMany
    {
        return $this->hasMany(DriverCardAdr::class, 'driver_license_uuid', 'uuid');
    }

    public function regions(): HasMany
    {
        return $this->hasMany(DriverLicense95Code::class, 'driver_license_uuid', 'uuid');
    }

    public function chipCard(): HasOne
    {
        return $this->hasOne(DriverChipCard::class, 'customer_uuid', 'customer_uuid');
    }

    public static function configureCipherSweet(
        EncryptedRow $encryptedRow
    ): void {
        $encryptedRow
            ->addField('series')
            ->addField('registrator')
            ->addField('number');
    }
}
