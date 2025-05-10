<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpgradeNotification extends Model
{
    protected $fillable = ['tenant_name', 'message'];
}
