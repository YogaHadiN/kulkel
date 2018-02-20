<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJenisStaseIdToJenisUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_ujians', function (Blueprint $table) {
			$table->integer('jenis_stase_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_ujians', function (Blueprint $table) {
			$table->dropColumn('jenis_stase_id')->nullable();
        });
    }
}
