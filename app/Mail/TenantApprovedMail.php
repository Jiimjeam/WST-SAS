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
    public $loginUrl;

    public function __construct($tenant, $password, $loginUrl)
    {
        $this->tenant = $tenant;
        $this->password = $password;
        $this->loginUrl = $loginUrl;
    }

    public function build()
    {
        return $this->subject('Welcome to Our Platform')
                    ->view('tenant.emails');
    }
}
