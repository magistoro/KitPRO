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
        Schema::create('rent_orders', function (Blueprint $table) {
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

            $table->date('rent_start')->nullable()->default(null);
            $table->date('rent_end')->nullable()->default(null);

            $table->dateTime('assembled_at')->nullable()->default(null);
            $table->dateTime('delivered_at')->nullable()->default(null);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_orders');
    }
};
