<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use App\Models\Tenant; // Or whatever model holds your tenants

class MigrateTenants extends Command
{
    protected $signature = 'tenants:migrate';
    protected $description = 'Run migrations for all tenant databases';

    public function handle()
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            $this->info("Migrating for tenant: {$tenant->name}");

            // Dynamically change DB connection
            Config::set('database.connections.tenant', [
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'database' => $tenant->database, // e.g., from `tenants` table
                'username' => 'root',
                'password' => '', // change based on your DB setup
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ]);

            DB::purge('tenant');
            DB::reconnect('tenant');

            // Run tenant migration
            Artisan::call('migrate', [
                '--path' => '/database/migrations/tenant',
                '--database' => 'tenant',
                '--force' => true,
            ]);

            $this->info("✔ Done with {$tenant->name}");
        }
    }
}
