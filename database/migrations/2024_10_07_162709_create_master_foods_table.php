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
        Schema::create('master_foods', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->float('calories');
            $table->float('fat');
            $table->float('carbohydrate');
            $table->float('protein');
            $table->string('image')->nullable();
            $table->string('brand');
            $table->string('src');
            $table->float('serving_qty');
            $table->string('serving_size');
            $table->float('cholestrol')->nullable();
            $table->float('fiber')->nullable();
            $table->float('sugar')->nullable();
            $table->float('sodium')->nullable();
            $table->float('kalium')->nullable();
            $table->string('categories');
            $table->unique(['food_name', 'brand']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_foods');
    }
};
