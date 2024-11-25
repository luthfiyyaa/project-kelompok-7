<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::create('pesan', function (Blueprint $table) {
            $table->increments('id_pesan')->primary();
            $table->text('isi');
            $table->string('lampiran')->nullable();
            $table->string('code_guest');
            $table->timestamps();

            $table->foreign('code_guest')->references('kode_guest')->on('guest')-> onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesans');
    }
};
