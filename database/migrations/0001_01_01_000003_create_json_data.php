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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->boolean('lactoseFree');
            $table->boolean('glutenFree');
            $table->string('ingredients');
        });

        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount');
        });

        Schema::create('salesOfLastWeek', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount');
        });

        Schema::create('wholesalePrices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount');
            $table->string('price');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('salesOfLastWeek');
        Schema::dropIfExists('wholesalePrices');
    }
};
