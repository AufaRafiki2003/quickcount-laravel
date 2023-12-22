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
        Schema::create('tpsuaras', function (Blueprint $table) {
            $table->id('id_tps');
            $table->string('no_tps');
            $table->unsignedBigInteger('id_kel');
            $table->timestamps();

            $table->foreign('id_kel')->references('id_kel')->on('kelurahans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tpsuaras');
    }
};
