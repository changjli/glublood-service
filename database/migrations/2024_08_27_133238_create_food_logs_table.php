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
            $table->string('date');
            $table->string('time');
            $table->integer('type');
            $table->unsignedBigInteger('user_id');
            $table->string('food_name');
            $table->float('calories')->nullable();
            $table->float('protein')->nullable();
            $table->float('carbohydrate')->nullable();
            $table->float('fat')->nullable();
            $table->float('serving')->nullable();
            $table->float('energy_from_fat')->nullable();
            $table->float('saturated_fat')->nullable();
            $table->float('cholestrol')->nullable();
            $table->float('sugar')->nullable();
            $table->float('natrium_sodium')->nullable();
            $table->float('vitamin_a')->nullable();
            $table->float('vitamin_b1')->nullable();
            $table->float('vitamin_b2')->nullable();
            $table->float('kolin')->nullable();
            $table->float('calcium')->nullable();
            $table->float('potassium')->nullable();
            $table->float('phospor')->nullable();
            $table->float('magnesium')->nullable();
            $table->float('zinc')->nullable();
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
