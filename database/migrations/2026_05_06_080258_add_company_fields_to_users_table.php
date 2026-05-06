<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_industry')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_address')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_mobile')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'company_phone',
                'company_industry',
                'company_city',
                'company_address',
                'contact_person',
                'contact_mobile',
            ]);
        });
    }
};