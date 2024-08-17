<?php

use App\Models\Respondent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId("respondent_id")->constrained()->onDelete('CASCADE');
            $table->integer('tingkatKepuasan');
            $table->date('tanggal')->default(DB::raw('CURDATE()'));
            $table->string('kritik')->default('tidak mengisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
