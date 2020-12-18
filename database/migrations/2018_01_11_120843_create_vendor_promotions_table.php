<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->string('promotion_amount',255)->nullable();
            $table->string('offer_type',255)->nullable()->comment = "1 For percent and 2 For fixed amount";
            $table->string('offer_wedding',255)->nullable();
            $table->enum('status',[1,0])->default(1);
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
        Schema::dropIfExists('vendor_promotions');
    }
}
