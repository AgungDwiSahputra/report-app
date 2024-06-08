<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('foto_profil')->nullable(false);
            $table->string('nama_lengkap')->nullable(false);
            $table->string('kata_sandi')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('no_telp')->nullable(false);
            $table->string('NPWP')->nullable(false);
            $table->string('NRP')->nullable(false);
            $table->date('tgl_lahir')->nullable(false);
            $table->string('jabatan')->nullable(false);
            $table->string('penempatan')->nullable(false);
            $table->enum('level', ['admin', 'babinsa', 'danramil', 'dandim', 'staf'])->nullable(false)->default('staf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
