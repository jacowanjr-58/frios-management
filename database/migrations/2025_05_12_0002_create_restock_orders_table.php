<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('restock_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchisee_id')->constrained()->onDelete('cascade');
            $table->timestamp('order_date')->useCurrent();
            $table->string('shipstation_order_id')->nullable();
            $table->enum('status',['awaiting_shipment','shipped','delivered'])->default('awaiting_shipment');
            $table->timestamp('ship_date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('restock_orders');
    }
};
