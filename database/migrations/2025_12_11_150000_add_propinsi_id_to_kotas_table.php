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
        Schema::table('kotas', function (Blueprint $table) {
            $table->foreignId('propinsi_id')->nullable()->after('id')->constrained('propinsis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kotas', function (Blueprint $table) {
            $table->dropForeign(['propinsi_id']);
            $table->dropColumn('propinsi_id');
        });
    }
};
