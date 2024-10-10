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
        Schema::create('setorprs', function (Blueprint $table) {
            $table->id();
            $table->string('noreg');
            $table->string('title');
            $table->string('keterangan');
            $table->foreignId('perusahaan_id')->constrained('perusahaans')->cascadeOnDelete();
            $table->foreignId('province_id')->constrained('provinces')->cascadeOnDelete();
            $table->foreignId('regency_id')->constrained('regencies')->cascadeOnDelete();
            $table->foreignId('koreksatu_id')->constrained('koreksatus')->cascadeOnDelete();
            $table->foreignId('korekdua_id')->constrained('korekduas')->cascadeOnDelete();
            $table->foreignId('korektiga_id')->constrained('korektigas')->cascadeOnDelete();
            $table->string('volume');
            $table->string('nilai');
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
        Schema::dropIfExists('setorprs');
    }
};
