<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengajuan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('id_pengajuan')->unsigned();
            $table->bigInteger('dibuat_oleh')->unsigned();
            $table->bigInteger('diterima_oleh')->unsigned();
            $table->string('wilayah_asal')->nullable(false);
            $table->text('deskripsi')->nullable(false);
            $table->bigInteger('diperintahkan_kepada')->unsigned();
            $table->string('tembusan')->nullable(false);
            $table->timestamps();

            $table->foreign('id_pengajuan')->references('id')->on('pengajuan');
            $table->foreign('dibuat_oleh')->references('id')->on('pengguna');
            $table->foreign('diterima_oleh')->references('id')->on('pengguna');
            $table->foreign('diperintahkan_kepada')->references('id')->on('pengguna');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengajuan');
    }
}
