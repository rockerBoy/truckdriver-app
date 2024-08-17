<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerLanguage extends Model
{
    use HasFactory;

    protected $table = 'customer_languages';

    public $fillable = [
        'language_id',
        'customer_uuid',
        'experience_level',
    ];

    /**
     * @return BelongsTo
     */
    public function additionalInfo(): BelongsTo
    {
        return $this->belongsTo(CustomerAdditionalInformation::class, 'customer_uuid', 'customer_uuid');
    }
}
