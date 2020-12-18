<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToContactEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_enquiries', function($table) {
            $table->string('number_of_guests',255)->after('comment')->nullable();
            $table->string('event_date',255)->after('number_of_guests')->nullable();
            $table->string('form_data',255)->after('event_date')->comment('2 for request form')->nullable();
            $table->string('company_id',255)->after('form_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('contact_enquiries', function($table) {
            $table->dropColumn('number_of_guests')->after('comment');
            $table->dropColumn('event_date');
            $table->dropColumn('form_data');
            $table->dropColumn('company_id');
        });
    }
}
