<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flavor_category_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flavor_category_id')->constrained('flavor_categories')->onDelete('cascade');
            $table->string('name');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['flavor_category_id','name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flavor_category_options');
    }
};
