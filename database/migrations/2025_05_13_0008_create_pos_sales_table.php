<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('pos_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchisee_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('sold_at')->useCurrent();
            $table->decimal('total_amount',10,2);
            $table->decimal('tips_amount',8,2)->default(0);
            $table->decimal('sales_tax_amount',8,2)->default(0);
            $table->boolean('tax_enabled')->default(true);
            $table->enum('payment_method',['cash','card','other'])->default('card');
            $table->string('stripe_payment_id')->nullable();
            $table->string('square_charge_id')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('pos_sales');
    }
};
