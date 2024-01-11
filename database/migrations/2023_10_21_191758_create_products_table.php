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
            $table->uuid('id')->primary();
            $table->string('name', 255)
                ->collation('utf8mb4_unicode_ci')
                ->unique()
                ->index()
                ; 
            $table->string('slug')
                ->unique()
                ;
            $table->text('description')
                ->collation('utf8mb4_unicode_ci')
                ;
            $table->decimal('price', 7, 2)
                ->index()
                ;
            $table->string('image', 191)
                ->collation('utf8mb4_unicode_ci')
                ->default('default.jpg')
                ;
            $table->string('thumbnail', 191)
                ->collation('utf8mb4_unicode_ci')
                ->default('default.jpg')
                ;
            $table->unsignedBigInteger('items_in_stock')
                ->default(0)
                ;
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete()
                ->restrictOnUpdate()
                ;
            $table->index('category_id');

            $table->foreignId('type_id')
                ->constrained('types')
                ->cascadeOnDelete()
                ->restrictOnUpdate()
                ;
            $table->index('type_id');

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
