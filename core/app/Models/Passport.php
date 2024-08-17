<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ParagonIE\CipherSweet\EncryptedRow;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;

class Passport extends Model implements CipherSweetEncrypted
{
    use HasFactory;
    use UUID;
    use UsesCipherSweet;

    protected $fillable = [
        'customer_uuid',
        'passport_series',
        'passport_number',
        'issues_date',
        'registrator',
        'registration_date',
        'martial_status',
        'country',
        'address',
    ];

    protected $table = 'passports';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'uuid', 'customer_uuid');
    }

    public static function configureCipherSweet(
        EncryptedRow $encryptedRow
    ): void {
        $encryptedRow
            ->addField('passport_series')
            ->addField('registrator')
            ->addField('country')
            ->addField('address');
    }
}
