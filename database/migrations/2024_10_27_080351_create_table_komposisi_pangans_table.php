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
        // Kode	Nama Bahan Makanan	energi
        Schema::create('table_komposisi_pangans', function (Blueprint $table) {
            $table->id();
            $table->string("kode");
            $table->string("namaMakana");
            $table->string("energi");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_komposisi_pangans');
    }
};
