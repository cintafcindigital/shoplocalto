<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_albums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('album_link');
            $table->string('couple_name',500);
            $table->enum('is_public',[0,1])->default(1);
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
        Schema::dropIfExists('user_albums');
    }
}
