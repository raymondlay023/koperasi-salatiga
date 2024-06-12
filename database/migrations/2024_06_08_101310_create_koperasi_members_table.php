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
        Schema::create('koperasi_members', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anggota');
            $table->string('alamat_anggota');
            $table->string('handphone');
            $table->string('tipe_member');
            $table->boolean('is_penabung')->nullable();
            $table->boolean('is_peminjam')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_members');
    }
};
