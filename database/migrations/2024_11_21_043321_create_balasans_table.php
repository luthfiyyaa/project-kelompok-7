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
        Schema::create('balasan', function (Blueprint $table) {
            $table->increments('id_balasan'); // hapus primary() karena tidak diperlukan
            $table->unsignedInteger('pesan_id'); // ubah ke unsignedInteger
            $table->unsignedInteger('code_admin'); // ubah ke unsignedInteger
            $table->text('isi_balasan');
            $table->timestamps();

            $table->foreign('pesan_id')->references('id_pesan')->on('pesan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('code_admin')->references('id_admin')->on('admin')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balasan');
    }
};
