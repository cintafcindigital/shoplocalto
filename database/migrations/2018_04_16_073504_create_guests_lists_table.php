<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name',255)->nullable();
            $table->string('attendance',255)->nullable();
            $table->string('menu',255)->nullable();
            $table->integer('group_id');
            $table->string('gender',255)->nullable();
            $table->string('age_type',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('postal_code',255)->nullable();
            $table->string('note',255)->nullable();
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
        Schema::dropIfExists('guests_lists');
    }
}
