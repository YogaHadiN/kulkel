<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnPengujiIdToUserIdInPengujisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('pengujis', function($t) {
			$t->renameColumn('penguji_id', 'user_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('pengujis', function($t) {
			$t->renameColumn('user_id', 'penguji_id');
		});
    }
}
