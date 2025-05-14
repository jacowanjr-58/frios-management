<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('role_requests', function (Blueprint $table) {
            if (Schema::hasColumn('role_requests', 'franchisee_id')) {
                $table->dropForeign(['franchisee_id']);
                $table->dropColumn('franchisee_id');
            }
            $table->json('franchisee_ids')->nullable()->after('desired_role');
        });
    }

    public function down(): void {
        Schema::table('role_requests', function (Blueprint $table) {
            $table->dropColumn('franchisee_ids');
            $table->foreignId('franchisee_id')->nullable()->constrained()->onDelete('set null');
        });
    }
};
