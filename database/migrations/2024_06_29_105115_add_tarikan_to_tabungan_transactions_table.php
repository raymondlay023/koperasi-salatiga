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
        Schema::table('tabungan_transactions', function (Blueprint $table) {
            //
            $table->integer('tarikan')->nullable()->after('setor');
            $table->integer('setor')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabungan_transactions', function (Blueprint $table) {
            //
            $table->dropColumn('tarikan');
            $table->integer('setor')->nullable(false)->change();
        });
    }
};
