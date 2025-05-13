<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchisee_id')->constrained()->onDelete('cascade');
            $table->foreignId('flavor_id')->nullable()->constrained()->nullOnDelete();
            $table->string('custom_name')->nullable();
            $table->foreignId('inventory_location_id')->constrained()->onDelete('cascade');
            $table->integer('cases_on_hand')->default(0);
            $table->integer('pops_on_hand')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('inventories');
    }
};
