<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant
{
    use HasDomains;
    protected $table = 'tenants';

    protected $fillable = [
        'data',
    ];

    protected $casts = [
        'data' => 'array', 
    ];
}
