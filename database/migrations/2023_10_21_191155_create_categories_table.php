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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 55)
                ->collation('utf8mb4_unicode_ci')
                ->unique()
                ;
            $table->string('slug')
                ->unique()
                ;
            $table->string('thumbnail', 191)
                ->collation('utf8mb4_unicode_ci')
                ->default('default.jpg')
                ;
            $table->nestedSet();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
