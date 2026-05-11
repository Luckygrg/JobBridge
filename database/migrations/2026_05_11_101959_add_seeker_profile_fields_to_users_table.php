<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('bio')->nullable()->after('phone');
            $table->string('skills')->nullable()->after('bio');
            $table->string('resume')->nullable()->after('skills');
            $table->string('linkedin')->nullable()->after('resume');
            $table->string('portfolio')->nullable()->after('linkedin');
            $table->string('profile_photo')->nullable()->after('portfolio');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'bio',
                'skills',
                'resume',
                'linkedin',
                'portfolio',
                'profile_photo',
            ]);
        });
    }
};