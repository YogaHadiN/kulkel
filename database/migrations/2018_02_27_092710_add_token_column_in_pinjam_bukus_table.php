<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenColumnInPinjamBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pinjam_bukus', function (Blueprint $table) {
			$table->string('token')->nullable();
			$table->integer('confirm')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pinjam_bukus', function (Blueprint $table) {
			$table->dropColumn('token');
			$table->dropColumn('confirm');
        });
    }
}
