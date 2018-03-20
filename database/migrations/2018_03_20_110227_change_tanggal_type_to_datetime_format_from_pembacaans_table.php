<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTanggalTypeToDatetimeFormatFromPembacaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembacaans', function (Blueprint $table) {
			$table->datetime('tanggal')->change();
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
			$table->date('tanggal')->change();
        });
    }
}
