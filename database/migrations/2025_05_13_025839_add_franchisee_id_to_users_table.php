<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->foreignId('franchisee_id')
              ->nullable()
              ->after('id')
              ->constrained()
              ->onDelete('set null');
        // Optionally add a role field:
        $table->enum('role',['super_admin','corporate_admin','franchise_admin','franchise_staff'])
              ->default('staff')
              ->after('franchisee_id');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['franchisee_id']);
        $table->dropColumn(['franchisee_id','role']);
    });
}

};
