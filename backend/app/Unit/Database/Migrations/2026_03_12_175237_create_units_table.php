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
        Schema::create("units", function (Blueprint $table) {
            $table->id();
            $table->string("standard_unit")->nullable();
            $table->string("name")->unique();
            $table->string("short_code")->unique();
            $table->string("icon");
            $table->unsignedTinyInteger("decimal_precision")->default(0);
            $table->timestamps();
        });

        Schema::create("unit_conversions", function (Blueprint $table) {
            $table->id();
            $table->foreignId("unit_id")->constrained()->restrictOnDelete();
            $table->foreignId("to_unit_id")->constrained("units")->restrictOnDelete();
            $table->unsignedInteger("value")->comment("1 unit = [value] to_unit");
            $table->enum("precision", ["exact", "approx"])->default("exact");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_conversions');
        Schema::dropIfExists('units');
    }
};
