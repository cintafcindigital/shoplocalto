<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToVendorQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('vendor_questions', function($table) {
            $table->string('question_id',255)->after('vendor_id');
            $table->text('answer')->after('question_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_questions',function($table){
            $table->dropColumn('question_id');
            $table->dropColumn('answer');
        });
    }
}
