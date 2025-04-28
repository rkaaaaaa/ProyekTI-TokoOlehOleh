<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ms_produk', function (Blueprint $table) {
            $table->id('idProduk');
            $table->integer('idUser');
            $table->string('namaProduk', 50);
            $table->integer('hargaProduk');
            $table->string('gambarProduk', 55);
            $table->text('deskripsiProduk')->nullable();
            $table->enum('kategoriProduk', ['Sambel', 'Makanan']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('ms_produk');
    }
};