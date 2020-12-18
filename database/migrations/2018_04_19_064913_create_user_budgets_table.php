<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('cat_id');
            $table->mediumText('concept');
            $table->integer('estimate_budget');
            $table->integer('final_cost');
            $table->integer('paid');
            $table->integer('pending');
            $table->mediumText('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_budgets');
    }
}
