<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flavor_flavor_category_option', function (Blueprint $table) {
            $table->foreignId('flavor_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('flavor_category_option_id')
                  ->constrained('flavor_category_options')
                  ->onDelete('cascade');
            $table->primary(['flavor_id','flavor_category_option_id'], 
                            'flv_flvcatopt_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flavor_flavor_category_option');
    }
};
