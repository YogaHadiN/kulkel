<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkMateriTerjemahanNamaFileTerjemahanToPembacaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembacaans', function (Blueprint $table) {
			$table->string('link_materi_terjemahan')->nullable();
			$table->string('nama_file_materi_terjemahan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembacaans', function (Blueprint $table) {
			$table->dropColumn('link_materi_terjemahan')->nullable();
			$table->dropColumn('nama_file_materi_terjemahan')->nullable();
        });
    }
}
