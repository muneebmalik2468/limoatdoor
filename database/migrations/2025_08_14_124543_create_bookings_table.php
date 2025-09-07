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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->dateTime('pickup_datetime');
            $table->integer('passengers');
            $table->integer('luggage')->default(0);
            $table->foreignId('vehicle_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('estimated_hours')->nullable();
            $table->string('iatan_account')->nullable();
            $table->decimal('ta_fee', 8, 2)->nullable();
            $table->boolean('with_pet')->default(false);
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->string('guest_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
