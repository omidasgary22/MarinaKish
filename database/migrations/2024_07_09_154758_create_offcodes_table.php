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
        Schema::create('offcodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code');
            $table->integer('percent');
            $table->integer('number');
            $table->datetime('expire_time');
            $table->datetime('start_time');
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offcodes');
    }
};
