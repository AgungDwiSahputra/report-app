<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_laporan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('id_laporan')->unsigned();
            $table->bigInteger('dibuat_oleh')->unsigned();
            $table->bigInteger('diterima_oleh')->unsigned();
            $table->string('wilayah_asal')->nullable(false);
            $table->string('hal_menonjol')->nullable(false);
            $table->text('deskripsi')->nullable(false);
            $table->string('cuaca')->nullable(false);
            $table->string('jml_personil')->nullable(true);
            $table->string('personil_hadir')->nullable(true);
            $table->string('personil_kurang')->nullable(true);
            $table->string('dinas_dalam')->nullable(true);
            $table->string('dinas_luar')->nullable(true);
            $table->string('piket_pos')->nullable(true);
            $table->string('materil')->nullable(false);
            $table->text('tembusan')->nullable(false);
            $table->text('lampiran')->nullable(false);
            $table->timestamps();

            $table->foreign('id_laporan')->references('id')->on('laporan');
            $table->foreign('dibuat_oleh')->references('id')->on('pengguna');
            $table->foreign('diterima_oleh')->references('id')->on('pengguna');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_laporan');
    }
}
