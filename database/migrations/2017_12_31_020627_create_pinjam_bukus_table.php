<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_bukus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('peminjam_id');
            $table->string('admin_id');
            $table->string('admin_kembalikan_id')->nullable();
            $table->string('perpus_id');
            $table->date('tanggal_pinjam');
            $table->date('perkiraan_tanggal_kembalikan');
            $table->date('tanggal_kembalikan')->nullable();
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
        Schema::dropIfExists('pinjam_bukus');
    }
}
