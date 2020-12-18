<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_partners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name',255)->nullable();
            $table->string('gender',255)->nullable();
            $table->string('avatar',255)->nullable();
            $table->string('partner_name',255)->nullable();
            $table->string('partner_gender',255)->nullable();
            $table->string('partner_avatar',255)->nullable();
            $table->string('wedding_date',255)->nullable();
            $table->string('venue',500)->nullable();
            $table->timestamps();
        });

        Schema::table('user_partners', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_partners');
    }
}
