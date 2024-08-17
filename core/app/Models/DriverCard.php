<?php

namespace App\Models\Driver;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCard extends Model
{
    use HasFactory;

    protected $table = 'driver_card';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public $fillable = [
        'number',
        'series',
        'registrator',
        'issue_date',
        'expiration_date',
        'have_adr',
        'need_adr',
        'have_95',
        'need_95',
        'have_chip_card',
        'need_chip_card',
    ];
}
