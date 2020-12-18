<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoAnswerListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_answer_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('list_id');
            $table->text('title');
            $table->mediumText('description')->nullable();
            $table->mediumText('note')->nullable();
            $table->integer('todo_date_id');
            $table->integer('todo_cat_id');
            $table->enum('task_status',[1,2,3])->default(1)->comment('1 = Pending, 2 = Completed, 3 = Cancel');
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
        Schema::dropIfExists('todo_answer_lists');
    }
}
