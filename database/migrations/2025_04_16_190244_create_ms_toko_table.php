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
        Schema::create('ms_toko', function (Blueprint $table) {
            $table->id('idToko'); // Primary key & auto increment
            $table->unsignedBigInteger('idUser'); // foreign key
            $table->string('namaToko', 25);
            $table->string('alamatToko', 55);

            $table->foreign('idUser')->references('idUser')->on('ms_user')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_toko');
    }
};
