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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('price');
            $table->integer('time');
            $table->integer('off_percent')->nullable();
            $table->integer('age_limited');
            $table->integer('total');
            $table->integer('pending');
            $table->text('description');
            $table->text('tip');
            $table->enum('off_suggestion',['yes','no'])->default('no');
            $table->enum('marina_suggestion',['yes','no'])->default('no');
            $table->time('started_at');
            $table->time('ended_at');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
