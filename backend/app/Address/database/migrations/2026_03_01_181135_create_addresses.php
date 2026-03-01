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
        Schema::create("addresses", function (Blueprint $table) {
            $table->id();
            $table->morphs("addressable", 'a_index');
            $table->string("line1");
            $table->string("line2")->nullable();
            $table->string("city");
            $table->string("state");
            $table->string("zipcode");
            $table->string("country");
            $table->json("coordinates")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
