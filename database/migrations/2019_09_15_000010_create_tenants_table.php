<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id(); 
            $table->string('status')->default('pending');
            $table->string('name');
            $table->string('clinic_name');
            $table->string('email')->unique();
            $table->string('contact_number')->nullable();
            $table->string('barangay_name')->nullable();
            $table->string('domain')->unique();
            $table->string('database')->nullable();
            $table->json('data')->nullable(); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
