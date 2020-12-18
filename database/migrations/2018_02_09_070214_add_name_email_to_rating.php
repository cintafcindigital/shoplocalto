<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameEmailToRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('vendor_ratings', function($table) {
            $table->string('name',255)->after('user_id')->nullable();
            $table->string('email',255)->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_ratings', function($table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
        });
    }
}
