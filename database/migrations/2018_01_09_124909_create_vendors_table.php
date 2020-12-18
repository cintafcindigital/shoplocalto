<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('vendor_id');
            $table->string('username',255);
            $table->string('contact_person',255);
            $table->string('telephone',255);
            $table->string('mobile',255)->nullable();
            $table->string('fax',255)->nullable();
            $table->string('website',255)->nullable();
            $table->string('email',255);
            $table->string('step_completed',25)->nullable();
            $table->integer('cat_id')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('vendors');
    }
}
