<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkLeafletFirstAnnouncementToSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seminars', function (Blueprint $table) {
            $table->string('link_first_announcement')->nullable();
            $table->string('link_final_announcement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seminars', function (Blueprint $table) {
            $table->dropColumn('link_first_announcement');
            $table->dropColumn('link_final_announcement');
        });
    }
}
