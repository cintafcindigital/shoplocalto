<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeddingWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wedding_websites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('website_link');
            $table->string('banner_image',255);
            $table->string('couple_name',255);
            $table->text('title');
            $table->longText('description');
            $table->string('background_color',255);
            $table->date('wedding_date');
            $table->text('note')->nullabe();
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
        Schema::dropIfExists('wedding_websites');
    }
}
