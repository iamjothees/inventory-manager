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
        Schema::create("locations", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("code");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("contact_persons", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("location_contact_person", function (Blueprint $table) {
            $table->primary(["location_id", "contact_person_id"]);
            $table->foreignId("location_id")->constrained()->restrictOnDelete();
            $table->foreignId("contact_person_id")->constrained('contact_persons')->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("location_contact_person");
        Schema::dropIfExists("contact_persons");
        Schema::dropIfExists("locations");
    }
};
