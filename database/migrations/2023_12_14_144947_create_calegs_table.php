git<?php

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
        Schema::create('calegs', function (Blueprint $table) {
            $table->id('id_caleg');
            $table->unsignedBigInteger('id_partai');
            $table->string('nama_caleg');
            $table->integer('no_urut_caleg');
            $table->unsignedBigInteger('id_dapil');
            $table->string('foto');
            $table->timestamps();

            $table->foreign('id_partai')->references('id_partai')->on('partais');
            $table->foreign('id_dapil')->references('id_dapil')->on('dapils');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calegs');
    }
};
