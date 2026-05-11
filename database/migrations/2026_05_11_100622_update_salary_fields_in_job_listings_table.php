<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn('salary');
            $table->decimal('salary_min', 10, 2)->nullable()->after('location');
            $table->decimal('salary_max', 10, 2)->nullable()->after('salary_min');
            $table->string('salary_currency')->default('NPR')->after('salary_max');
            $table->enum('salary_type', ['negotiable', 'fixed', 'range'])->default('negotiable')->after('salary_currency');
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn(['salary_min', 'salary_max', 'salary_currency', 'salary_type']);
            $table->string('salary')->nullable();
        });
    }
};