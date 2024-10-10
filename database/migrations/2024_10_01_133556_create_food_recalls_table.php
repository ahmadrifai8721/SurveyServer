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
        Schema::create('food_recalls', function (Blueprint $table) {
            $table->id();
            $table->string("users_id");
            $table->foreignId("daftar_balita_id");
            $table->string("posyandu");
            $table->string("waktu");
            $table->string("namaMasakan");
            $table->string("jenis");
            $table->string("urt");
            $table->string("gram");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_recalls');
    }
};
