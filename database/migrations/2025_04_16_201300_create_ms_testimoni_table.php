<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ms_testimoni', function (Blueprint $table) {
            $table->id('idTestimoni');
            $table->unsignedBigInteger('idUser'); // asumsi idUser dari sesi login
            $table->string('gambarTestimoni'); // path gambar
            $table->date('tanggalTestimoni');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_testimoni');
    }
};
