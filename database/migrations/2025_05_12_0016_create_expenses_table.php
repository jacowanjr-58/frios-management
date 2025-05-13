<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchisee_id')->constrained()->onDelete('cascade');
            $table->date('expense_date');
            $table->foreignId('expense_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('expense_sub_category_id')->constrained()->onDelete('cascade');
            $table->string('vendor')->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount',10,2);
            $table->string('receipt_url')->nullable();
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('expenses');
    }
};
