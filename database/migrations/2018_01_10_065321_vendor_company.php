<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VendorCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('vendor_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->string('country',255);
            $table->string('city',255)->nullable();
            $table->string('postal_code',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('business_name',255);
            $table->text('business_detail',255)->nullable();
            $table->string('business_address',255);
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
        Schema::dropIfExists('vendor_companies');
    }
}
