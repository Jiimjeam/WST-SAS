<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tenant;
    public $password;

    public function __construct($tenant, $password)
    {
        $this->tenant = $tenant;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your Tenant Account Has Been Approved')
            ->view('tenant.emails');
    }
}
