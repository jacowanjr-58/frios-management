<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('restock_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restock_order_id')->constrained()->onDelete('cascade');
            $table->foreignId('flavor_id')->constrained()->onDelete('cascade');
            $table->integer('quantity_cases');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('restock_order_items');
    }
};
