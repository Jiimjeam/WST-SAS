<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    /**
     * Specify which columns should NOT be stored in the JSON `data` column
     */
          protected $fillable = [
        'name', 'email', 'contact_number', 'barangay_name', 'clinic_name', 'domain', 'database'
    ];


    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'contact_number',
            'clinic_name',
            'barangay_name',
            'domain',
            'database',
        ];
    }
}

