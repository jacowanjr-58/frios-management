<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('restock_order_additional_charge', function (Blueprint $table) {
            $table->foreignId('restock_order_id')->constrained()->onDelete('cascade');
            $table->foreignId('additional_charge_id')->constrained()->onDelete('cascade');
            $table->boolean('included')->default(true);
            $table->primary(['restock_order_id','additional_charge_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('restock_order_additional_charge');
    }
};
