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
        Schema::create('food_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('type');
            $table->unsignedBigInteger('user_id');
            $table->string('food_name');
            $table->float('calories');
            $table->float('protein');
            $table->float('carbohydrate');
            $table->float('fat');
            $table->float('serving_qty');
            $table->string('serving_size');
            $table->string('brand')->nullable();
            $table->float('cholestrol')->nullable();
            $table->float('fiber')->nullable();
            $table->float('sugar')->nullable();
            $table->float('sodium')->nullable();
            $table->float('kalium')->nullable(); // potassium
            $table->string('categories')->nullable();
            // fatsecrete
            $table->float('salt')->nullable();
            $table->float('calcium')->nullable();
            $table->float('phosporus')->nullable();
            $table->float('magnesium')->nullable();
            $table->float('zinc')->nullable();
            $table->float('selenium')->nullable();
            $table->string('barcode')->nullable();
            $table->string('note')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_logs');
    }
};
