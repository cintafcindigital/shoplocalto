<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToUserBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('user_budgets', function($table) {
            $table->integer('task_id')->after('note');
            $table->date('paid_date')->after('task_id');
            $table->string('paid_by',255)->after('paid_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_budgets',function($table){
            $table->dropColumn('task_id');
            $table->dropColumn('paid_date');
            $table->dropColumn('paid_by');
        });
    }
}
