<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherFieldsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('users', function($table) {
            $table->string('address',255)->after('password')->nullable();
            $table->string('country',255)->after('address')->nullable();
            $table->string('phone',255)->after('country')->nullable();
            $table->string('event_date',255)->after('phone')->nullable();
            $table->string('event_role',255)->after('event_date')->nullable();
            $table->string('mail_allow',255)->after('event_role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('phone');
            $table->dropColumn('event_date');
            $table->dropColumn('event_role');
            $table->dropColumn('mail_allow');
        });
    }
}
