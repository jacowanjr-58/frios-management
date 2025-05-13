<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flavor_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();      // e.g. "Availability", "Flavor", "Allergen"
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flavor_categories');
    }
};
