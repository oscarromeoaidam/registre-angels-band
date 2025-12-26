<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('instrumentists', function (Blueprint $table) {
            if (Schema::hasColumn('instrumentists', 'instrument_id')) {
                $table->dropForeign(['instrument_id']);
                $table->dropColumn('instrument_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('instrumentists', function (Blueprint $table) {
            $table->foreignId('instrument_id')->nullable()->constrained('instruments')->nullOnDelete();
        });
    }
};
