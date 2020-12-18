<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->text('label_title')->nullable();
            $table->text('label_slug')->nullable();
            $table->text('options')->nullable();
            $table->string('status',25)->default(1);
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
        Schema::dropIfExists('question_fields');
    }
}
