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
        Schema::create('order_sold_products', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('sold_order_id')
                ->constrained('sold_orders')
                ->cascadeOnDelete()
                ->restrictOnUpdate()
                ;


                $table->foreignUuid('product_id')->nullable()
                ->constrained('products')
                ->cascadeOnDelete()
                ->restrictOnUpdate()
                ;

                $table->unsignedBigInteger('quantity')
            ->default(0)
            ;

            $table->timestamp('assembled_at')->nullable()->default(null);
            $table->timestamp('return_date')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_sold_products');
    }
};
