<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->integer('cat_id');
            $table->string('is_mandatory',5)->default(0);
            $table->string('sequence_number',5)->nullable();
            $table->text('note')->nullable();
            $table->string('status',5)->default(1);
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
        Schema::dropIfExists('assign_questions');
    }
}
