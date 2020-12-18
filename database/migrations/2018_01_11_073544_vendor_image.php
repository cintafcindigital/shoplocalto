<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VendorImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->string('vendor_folder')->nullable();
            $table->text('image');
            $table->enum('is_logo',[1,0])->default(0);
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
          Schema::dropIfExists('vendor_images');
    }
}
