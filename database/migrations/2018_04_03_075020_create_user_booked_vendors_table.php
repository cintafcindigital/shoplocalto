<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBookedVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_booked_vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('vendor_id');
            $table->integer('book_status')->default(3)->comment('1 = Not available, 2 = Discarded, 3 = Evaluating, 4 = Preselection, 5 = Negotiation, 6 = Reserved');
            $table->integer('rating')->default(0);
            $table->integer('price')->default(0);
            $table->text('add_note')->nullable();
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
        Schema::dropIfExists('user_booked_vendors');
    }
}
