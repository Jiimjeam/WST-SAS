<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureSetting extends Model
{
    protected $fillable = ['feature_name', 'is_enabled'];
}
