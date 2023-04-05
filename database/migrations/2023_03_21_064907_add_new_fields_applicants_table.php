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
        Schema::table('applicants', function (Blueprint $table) {
            $table->integer('salary')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            $table->string('language')->nullable();
            $table->string('highlights')->nullable();
            $table->string('avatar')->nullable();
            $table->string('resume')->nullable();
            $table->boolean('looking_for_job')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            //
        });
    }
};
