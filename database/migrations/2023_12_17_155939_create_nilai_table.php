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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->default('');
            $table->string('nama_peserta');
            $table->string('nama_fasilitator');
            $table->decimal('nilai_akhir', 5, 2);
            $table->integer('presensi');
            $table->decimal('total_nilai', 5, 2);
            $table->string('konversi_nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
