<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->string('min_price_per_guest',255)->nullable();
            $table->string('min_number_guest',255)->nullable();
            $table->string('max_number_guest',255)->nullable();
            $table->string('event_spaces',255)->nullable();
            $table->string('included_in_package',255)->nullable();
            $table->string('venue_location',255)->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('vendor_questions');
    }
}
