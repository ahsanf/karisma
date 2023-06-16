<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_member', function (Blueprint $table) {
            $table->tinyInteger('presence')->after('member_id')->default(2)->comment('0: not present, 1: present, 2: no answer');
            $table->tinyInteger('status')->after('presence')->default(0)->comment('0: pending, 1: sent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_member', function (Blueprint $table) {
            //
        });
    }
};
