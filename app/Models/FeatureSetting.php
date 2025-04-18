<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FeatureSetting extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['feature_name', 'is_enabled'];
}
