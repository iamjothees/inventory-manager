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
        return;
        // units

        Schema::create("items", function (Blueprint $table) {
            $table->id();
            $table->string("type")->default("inventory")->index(); // inventory, service, kit
            $table->foreignId("base_item_id")
                ->comment("kit_id for kit items, base_item_id for variant items")
                ->nullable()
                ->constrained('items')
                ->restrictOnDelete();
            $table->string("name");
            $table->string("slug")->unique();
            $table->string("image")->nullable();
            $table->foreignId("unit_id")->constrained()->restrictOnDelete();
            $table->unsignedInteger("shelf_life")->nullable()->comment("in hours");
            $table->timestamps();
        });

        Schema::create("item_unit_conversions", function (Blueprint $table) {
            $table->id();
            $table->foreignId("item_id")->constrained()->restrictOnDelete();
            $table->foreignId("unit_id")->constrained()->restrictOnDelete();
            $table->unsignedInteger("value")->comment("1 base_unit = [value] unit");
            $table->enum("precision", ["exact", "approx"])->default("exact");
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
        Schema::dropIfExists("item_unit_conversions");
        Schema::dropIfExists("items");
        Schema::dropIfExists("unit_conversions");
        Schema::dropIfExists("units");
        Schema::dropIfExists("location_contact_persons");
        Schema::dropIfExists("locations");
    }
};
