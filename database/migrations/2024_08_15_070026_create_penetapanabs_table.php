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
        Schema::create('penetapanabs', function (Blueprint $table) {
            $table->id();
            $table->string('iden');
            $table->string('noreg');
            $table->foreignId('perusahaan_id')->constrained('perusahaans')->cascadeOnDelete();
            $table->foreignId('uptd_id')->constrained('uptds')->cascadeOnDelete();
            $table->foreignId('koreksatu_id')->constrained('koreksatus')->cascadeOnDelete();
            $table->foreignId('korekdua_id')->constrained('korekduas')->cascadeOnDelete();
            $table->foreignId('korektiga_id')->constrained('korektigas')->cascadeOnDelete();
            $table->foreignId('kualitasair_id')->constrained('kualitasairs')->cascadeOnDelete();
            $table->string('volumeab');
            $table->string('nilaiab');
            $table->string('tglsetor');
            $table->string('image');
            $table->foreignId('pegawai_id')->constrained('pegawais')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penetapanabs');
    }
};
