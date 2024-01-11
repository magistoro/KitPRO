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
        Schema::create('sold_orders', function (Blueprint $table) {
            $table->id();

            $table->string('customer_to', 255);
            $table->string('customer_phone', 255);
            $table->string('customer_email', 255);
            $table->string('address', 255);
            $table->string('comment', 1024)->nullable();

            $table->foreignUuid('user_id')->nullable()
            ->constrained('users')
            ->cascadeOnDelete()
            ->restrictOnUpdate()
            ;

            $table->dateTime('assembled_at')->nullable()->default(null);
            $table->dateTime('dispatched_at')->nullable()->default(null);
            $table->dateTime('delivered_at')->nullable()->default(null);
            $table->dateTime('cancelled_at')->nullable()->default(null);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sold_orders');
    }
};
