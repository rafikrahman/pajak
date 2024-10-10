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
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uptd_id')->constrained('uptds')->cascadeOnDelete();
            $table->foreignId('koreksatu_id')->constrained('koreksatus')->cascadeOnDelete();
            $table->foreignId('korekdua_id')->constrained('korekduas')->cascadeOnDelete();
            $table->foreignId('korektiga_id')->constrained('korektigas')->cascadeOnDelete();
            $table->string('nilaitarget');
            $table->string('tahun');
            $table->string('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
