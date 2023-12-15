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
        Schema::create('rekap_suara_calegs', function (Blueprint $table) {
            $table->id('id_rsc');
            $table->unsignedBigInteger('id_tps');
            $table->unsignedBigInteger('id_caleg');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_caleg')->references('id_caleg')->on('calegs');
            $table->foreign('id_tps')->references('id_tps')->on('tpsuaras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_suara_calegs');
    }
};
