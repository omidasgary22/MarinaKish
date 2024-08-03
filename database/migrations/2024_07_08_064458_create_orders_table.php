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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('product_id');
            $table->unsignedBigInteger('factor_id')->nullable();
            $table->unique(['user_id','product_id']);
            $table->integer('number');
            $table->enum('status', ['payment', 'Awaiting Payment', 'Cancellation'])->default('payment');
            $table->dateTime('sans_id');
            $table->date('day_reserved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
