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
        Schema::create('a_p_k_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('version')->unique();
            $table->string('description');
            $table->string('file_path');
            $table->integer('size')->nullable();
            $table->integer('download')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_p_k_s');
    }
};
