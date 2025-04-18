<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Medicine extends Model implements Auditable
{   
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $connection = 'tenant';

    protected $fillable = ['medicine_name', 'quantity'];
}