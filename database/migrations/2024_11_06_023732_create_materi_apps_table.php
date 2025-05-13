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

        //      [
        //   {'image': 'assets/images/kia.png', 'text': 'KIA'},
        //   {'image': 'assets/images/gigi.png', 'text': 'Gigi'},
        //   {'image': 'assets/images/kkr.png', 'text': 'KKR'},
        //   {'image': 'assets/images/kb.png', 'text': 'KB'},
        //   {'image': 'assets/images/tb.png', 'text': 'TB'},
        //   {'image': 'assets/images/lansia.png', 'text': 'Lansia'},
        //   {'image': 'assets/images/farmasi.png', 'text': 'Farmasi'},
        //   {'image': 'assets/images/gizi.png', 'text': 'Gizi'},
        //   {'image': 'assets/images/imunisasi.png', 'text': 'Imunisasi'},
        //   {'image': 'assets/images/ptm.png', 'text': 'PTM'},
        //   {'image': 'assets/images/kesling.png', 'text': 'Kesling'},
        //   {'image': 'assets/images/lab.png', 'text': 'Laboratorium'},
        //   {'image': 'assets/images/promkes.png', 'text': 'Promkes'},
        //   {'image': 'assets/images/batra.png', 'text': 'Batra'},
        // ]

        // $table->json("kia");
        // $table->json("kb");
        // $table->json("gizi");
        // $table->json("imunisasi");
        // $table->json("kkr");
        // $table->json("tb");
        // $table->json("ptm");
        // $table->json("lansia");
        // $table->json("promkes");
        // $table->json("kesling");
        // $table->json("gigi");
        // $table->json("laboratorium");
        // $table->json("farmasi");
        // $table->json("batra");

        Schema::create('materi_apps', function (Blueprint $table) {
            $table->id();
            $table->integer("index")->nullable();
            $table->string("menu");
            $table->longText("materi");
            $table->json("materi_pic_list")->nullable();
            $table->longText("materi_pdf")->nullable();
            $table->longText("materi_vid")->nullable();
            $table->string("cp")->nullable();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_apps');
    }
};
