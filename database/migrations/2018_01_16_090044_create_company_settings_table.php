<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',255)->nullable();
            $table->string('phone_number',255)->nullable();
            $table->string('toll_free_number',255)->nullable();
            $table->string('fax_number',255)->nullable();
            $table->string('email_id',255)->nullable();
            $table->string('email_goes_to',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('map_address',255)->nullable();
            $table->string('logo',255)->nullable();
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
        Schema::dropIfExists('company_settings');
    }
}
