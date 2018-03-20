<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkAndNamaFileMateriToPembacaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembacaans', function (Blueprint $table) {
			$table->string('nama_file_materi');
			$table->string('link_materi');
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
			$table->dropColumn('nama_file_materi');
			$table->dropColumn('link_materi');
        });
    }
}
