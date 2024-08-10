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
        Schema::create('diabetes_predictions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('pregnancies');
            $table->float('glucose');
            $table->float('blood_pressure');
            $table->float('skin_thickness');
            $table->float('insulin');
            $table->float('weight');
            $table->float('height');
            $table->integer('is_father');
            $table->integer('is_mother');
            $table->integer('is_sister');
            $table->integer('is_brother');
            $table->integer('age');
            $table->integer('result');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diabetes_predictions');
    }
};
