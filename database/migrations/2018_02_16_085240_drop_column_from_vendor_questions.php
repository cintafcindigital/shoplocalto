<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnFromVendorQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('vendor_questions', function($table) {
             $table->dropColumn('min_price_per_guest');
             $table->dropColumn('min_number_guest');
             $table->dropColumn('max_number_guest');
             $table->dropColumn('event_spaces');
             $table->dropColumn('included_in_package');
             $table->dropColumn('venue_location');
          });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('vendor_questions', function($table){
            $table->string('min_price_per_guest',255)->nullable();
            $table->string('min_number_guest',255)->nullable();
            $table->string('max_number_guest',255)->nullable();
            $table->string('event_spaces',255)->nullable();
            $table->string('included_in_package',255)->nullable();
            $table->string('venue_location',255)->nullable();
          });
    }
}
