<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url',500);
            $table->string('title',255);
            $table->string('image',255);
            $table->longText('image_description');
            $table->longText('description');
            $table->mediumText('meta_title');
            $table->mediumText('meta_description');
            $table->mediumText('meta_keyword');
            $table->enum('status',[1,0]);
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
        Schema::dropIfExists('pages');
    }
}
