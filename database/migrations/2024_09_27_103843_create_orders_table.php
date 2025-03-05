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
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('montir_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('vehicleName',50);
            $table->string('steeringWheelPhoto');
            $table->string('status',20);
            $table->date('scheduleDate');
            $table->string('scheduleTime');
            $table->timestamps();
            $table->softDeletes(); // Add soft delete column
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
