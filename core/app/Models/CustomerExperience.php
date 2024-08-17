<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerExperience extends Model
{
    use HasFactory, UUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'customer_uuid',
        'general_exp',
        'work_places',
    ];

    protected $table = 'customer_experience';

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

    public function trailers(): HasMany
    {
        return $this->hasMany(DriverTrailer::class, 'customer_uuid', 'customer_uuid');
    }
}
