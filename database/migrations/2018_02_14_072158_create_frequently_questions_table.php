<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrequentlyQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequently_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->string('type',255)->nullable();
            $table->text('description')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('frequently_questions');
    }
}
