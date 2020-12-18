<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->integer('user_id');
            $table->integer('quality_of_service')->comment('Rating out of 5');
            $table->integer('responsiveness')->comment('Rating out of 5');
            $table->integer('professionalism')->comment('Rating out of 5');
            $table->integer('value')->comment('Rating out of 5');
            $table->integer('flexibility')->comment('Rating out of 5');
            $table->float('average_rating')->comment('Already calculated for this record');
            $table->text('review_title')->nullable();
            $table->mediumText('review_description')->nullable();
            $table->string('review_image',255)->nullable();
            $table->string('services_cost',255)->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('vendor_ratings');
    }
}
