<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'first_name_en',
        'last_name_en',
        'birth_date',
        'patronymic',
    ];

    protected $table = 'customers';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;
}
