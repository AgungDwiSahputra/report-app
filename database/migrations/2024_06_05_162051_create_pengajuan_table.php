<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('jenis_pengajuan')->nullable(false);
            $table->string('judul_pengajuan')->nullable(false);
            $table->text('file_pengajuan')->nullable(true);
            $table->enum('status', ['valid', 'publish', 'agree', 'disagree'])->nullable(false)->default('disagree');
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
        Schema::dropIfExists('pengajuan');
    }
}
