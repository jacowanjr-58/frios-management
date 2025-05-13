<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flavors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->decimal('price_per_case', 8, 2)->default(0);
            $table->integer('pops_per_case')->default(48);
            $table->decimal('cost_per_case', 8, 2)->nullable();
            $table->boolean('orderable')->default(true);
            $table->string('image_icon_url')->nullable();
            $table->string('image_nutrition_url')->nullable();
            $table->string('image_marketing_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flavors');
    }
};
