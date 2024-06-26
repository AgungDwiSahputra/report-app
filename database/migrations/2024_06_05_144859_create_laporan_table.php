<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('jenis_laporan')->nullable(false);
            $table->string('judul_laporan')->nullable(false);
            $table->text('file_laporan')->nullable(true);
            $table->enum('status', ['not-verify','verification','publish', 'valid', 'invalid'])->nullable(false)->default('invalid');
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
        Schema::dropIfExists('laporan');
    }
}
