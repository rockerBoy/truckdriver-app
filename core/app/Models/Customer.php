<?php

namespace App\Models;

use App\Models\Driver\DriverChipCard;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use ParagonIE\CipherSweet\EncryptedRow;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;

class Customer extends Model implements CipherSweetEncrypted
{
    use HasFactory;
    use UUID;
    use UsesCipherSweet;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'first_name_en',
        'last_name_en',
        'birth_date',
        'patronymic',
        'phone_number',
        'phone_messengers',
        'phone_number_alt',
        'phone_alt_messengers',
    ];

    protected $table = 'customers';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public function passport(): HasOne
    {
        return $this->hasOne(Passport::class, 'customer_uuid', 'uuid');
    }

    public function chip(): HasOne
    {
        return $this->hasOne(DriverChipCard::class, 'customer_uuid', 'uuid');
    }

    public function trailers(): HasMany
    {
        return $this->hasMany(DriverTrailer::class, 'customer_uuid', 'uuid');
    }

    public static function configureCipherSweet(
        EncryptedRow $encryptedRow
    ): void {
        $encryptedRow
            ->addField('first_name')
            ->addField('last_name')
            ->addOptionalTextField('phone_number')
            ->addOptionalTextField('phone_number_alt')
            ->addOptionalTextField('email')
            ->addField('first_name_en')
            ->addField('last_name_en')
            ->addField('patronymic');
    }
}
