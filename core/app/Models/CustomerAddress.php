<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ParagonIE\CipherSweet\EncryptedRow;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;

class CustomerAddress extends Model implements CipherSweetEncrypted
{
    use HasFactory;
    use UUID;
    use UsesCipherSweet;

    protected $table = 'customer_addresses';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'customer_uuid',
        'country',
        'region',
        'city',
        'district',
        'street',
        'building',
        'house',
        'apartment',
        'zip',
        'additional_zip',
        'has_additional_zip',
    ];

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
            ->addField('country')
            ->addField('region')
            ->addField('city')
            ->addField('district')
            ->addField('street')
            ->addField('building')
            ->addField('house')
            ->addField('apartment')
            ->addField('zip')
            ->addField('additional_zip');
    }
}
