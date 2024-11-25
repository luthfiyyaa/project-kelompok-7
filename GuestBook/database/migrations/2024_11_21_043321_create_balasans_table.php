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
        Schema::create('balasan', function (Blueprint $table) {
            $table -> string('id_balasan')->primary();
            $table -> string('pesan_id');
            $table -> string('code_admin');
            $table -> text('isi_balasan');
            $table -> timestamps();

            $table->foreign('pesan_id')->references('id_pesan')->on('pesan')-> onDelete('cascade')->onUpdate('cascade');
            $table->foreign('code_admin')->references('kode_admin')->on('admin')-> onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balasans');
    }
};
