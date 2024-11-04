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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('national_code')->unique();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->enum('gender',['mail', 'female'])->nullable();
            $table->string('password');
            $table->date('birth_day')->nullable();
            $table->dateTime('phone_verified_at')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
