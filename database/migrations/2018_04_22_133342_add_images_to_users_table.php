<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->string('ktp_pic');
			$table->string('ijazah_sd_pic');
			$table->string('ijazah_smp_pic');
			$table->string('ijazah_smu_pic');
			$table->string('ijazah_sked_pic');
			$table->string('ijazah_dokter_pic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('ktp_pic');
			$table->dropColumn('ijazah_sd_pic');
			$table->dropColumn('ijazah_smp_pic');
			$table->dropColumn('ijazah_smu_pic');
			$table->dropColumn('ijazah_sked_pic');
			$table->dropColumn('ijazah_dokter_pic');
        });
    }
}
