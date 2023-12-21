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
        Schema::create('rekap_suara_partais', function (Blueprint $table) {
            $table->id('id_rsp');
            $table->unsignedBigInteger('id_partai');
            $table->unsignedBigInteger('id_tps');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_tps')->references('id_tps')->on('tpsuaras');
            $table->foreign('id_partai')->references('id_partai')->on('partais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_suara_partais');
    }
};
