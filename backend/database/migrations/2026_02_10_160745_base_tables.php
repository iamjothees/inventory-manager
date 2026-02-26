<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
        });

        Schema::create("units", function (Blueprint $table) {
            $table->id();
            $table->string("standard_unit")->nullable();
            $table->string("name");
            $table->string("code");
            $table->unsignedTinyInteger("decimal_precision")->default(0);
            $table->timestamps();
        });

        Schema::create("items", function (Blueprint $table) {
            $table->id();
            $table->string("type")->default("inventory");
            $table->foreignId("base_id")->nullable()
                ->constrained('items')->restrictOnDelete();
            $table->string("name");
            $table->string("slug");
            $table->string("image")->nullable();
            $table->timestamps();
        });

        Schema::create("inventories", function (Blueprint $table) {
            $table->id();
            $table->unique(["location_id", "item_id", "unit_id"]);
            $table->foreignId("location_id")->constrained()->restrictOnDelete();
            $table->foreignId("item_id")->constrained()->restrictOnDelete();
            $table->foreignId("unit_id")->constrained()->restrictOnDelete();
            $table->unsignedInteger("quantity")->default(0);
        });

        Schema::create("inventory_transactions", function (Blueprint $table) {
            $table->id();
            $table->foreignId("inventory_id")->constrained()->cascadeOnDelete();
            $table->morphs("transactionable", 'it_index');
            $table->string("action");
            $table->integer("quantity");
            $table->enum("type", ["in", "out"]);
            $table->text("notes")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("inventory_transactions");
        Schema::dropIfExists("inventories");
        Schema::dropIfExists("items");
        Schema::dropIfExists("units");
        Schema::dropIfExists("locations");
    }
};
