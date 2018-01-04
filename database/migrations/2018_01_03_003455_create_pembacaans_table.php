<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembacaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembacaans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->date('tanggal');
            $table->string('judul')->nullable();
            $table->string('doi')->nullable();
            $table->string('jenis_pembacaan_id');
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
        Schema::dropIfExists('pembacaans');
    }
}
