<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Transaction extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'patient_name',
        'age',
        'gender',
        'description',
        'medicine_given',
        'quantity',
    ];
}
