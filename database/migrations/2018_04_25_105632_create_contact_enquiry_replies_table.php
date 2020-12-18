<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactEnquiryRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_enquiry_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquiry_id');
            $table->integer('user_id');
            $table->string('name',255)->nullable();
            $table->string('email',255);
            $table->integer('company_id');
            $table->integer('reply_by')->comment('If 0 = admin, if any id then vendor_id');
            $table->string('title',255)->nullable();
            $table->mediumText('message');
            $table->enum('is_read',[0,1])->default(0);
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
        Schema::dropIfExists('contact_enquiry_replies');
    }
}
