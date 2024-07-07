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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('fullname');
            $table->decimal('weight');
            $table->decimal('height');
            $table->integer('age');
            $table->date('DOB');
            $table->string('gender');
            $table->boolean('is_descendant_diabetes');
            $table->boolean('is_diabetes');
            $table->string('medical_history');
            $table->integer('diabetes_type');
            $table->timestamps();
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
