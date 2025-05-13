<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('pos_sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pos_sale_id')->constrained()->onDelete('cascade');
            $table->foreignId('flavor_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price',8,2);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('pos_sale_items');
    }
};
