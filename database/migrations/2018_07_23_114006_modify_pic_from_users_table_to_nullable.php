<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPicFromUsersTableToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			DB::statement('ALTER TABLE users MODIFY ktp_pic VARCHAR(255) null, MODIFY ijazah_sd_pic VARCHAR(255) null, MODIFY ijazah_smp_pic VARCHAR(255) null, MODIFY ijazah_smu_pic VARCHAR(255) null, MODIFY ijazah_sked_pic VARCHAR(255) null, MODIFY ijazah_dokter_pic VARCHAR(255) null, MODIFY profile_pic VARCHAR(255) null;');
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
			DB::statement('ALTER TABLE users MODIFY ktp_pic VARCHAR(255) not null, MODIFY ijazah_sd_pic VARCHAR(255) not null, MODIFY ijazah_smp_pic VARCHAR(255) not null, MODIFY ijazah_smu_pic VARCHAR(255) not null, MODIFY ijazah_sked_pic VARCHAR(255) not null, MODIFY ijazah_dokter_pic VARCHAR(255) not null, MODIFY profile_pic VARCHAR(255) not null;');
        });
    }
}
