<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateTenantDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-tenant-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenant = $this->argument('tenant');
        $dbName = "tenant_" . $tenant;

        // Create database
        DB::statement("CREATE DATABASE `$dbName`");

        // Run migrations
        tenancy()->initialize($tenant);
        Artisan::call('tenants:artisan', [
            'artisanCommand' => 'migrate --database=tenant',
            '--tenant' => [$tenant]
        ]);
    }
}
