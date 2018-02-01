<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStasesRenamePeriodeBulanToMulai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('stases', function($t) {
			$t->renameColumn('periode_bulan', 'mulai');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('stases', function($t) {
			$t->renameColumn('mulai', 'periode_bulan');
		});
    }
}
