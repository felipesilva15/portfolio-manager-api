<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('job_title', 40);
            $table->string('avatar_url', 512)->nullable();
            $table->string('phone_number', 11);
            $table->date('birth_date')->nullable();
            $table->string('locality', 120);
            $table->text('about');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('job_title');
            $table->dropColumn('avatar_url');
            $table->dropColumn('phone_number');
            $table->dropColumn('birth_date');
            $table->dropColumn('locality');
            $table->dropColumn('about');
        });
    }
};
