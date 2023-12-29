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
        Schema::create('rekap_suaras', function (Blueprint $table) {
            $table->id('id_rekap');
            $table->unsignedBigInteger('id_paslon');
            $table->unsignedBigInteger('id_tps');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_paslon')->references('id_paslon')->on('paslons');
            $table->foreign('id_tps')->references('id_tps')->on('tpsuaras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_suaras');
    }
};
