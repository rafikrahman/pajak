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
        Schema::create('perusahaanpaps', function (Blueprint $table) {
            $table->id();
            $table->string('iden');
            $table->string('noreg');
            $table->string('name');
            $table->foreignId('uptd_id')->constrained('uptds');
            $table->string('alamat');
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('regency_id')->constrained('regencies');
            $table->foreignId('district_id')->constrained('districts');
            $table->string('email')->unique();
            $table->string('website');
            $table->string('namekontak');
            $table->string('ponsel');
            $table->string('emailkontak')->unique();
            $table->foreignId('koreksatu_id')->constrained('koreksatus');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaanpaps');
    }
};
