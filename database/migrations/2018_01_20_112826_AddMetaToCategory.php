<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaToCategory extends Migration
{
    //
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function($table) {
            $table->mediumText('meta_title')->after('status')->nullable();
            $table->mediumText('meta_keyword')->after('meta_title')->nullable();
            $table->mediumText('meta_description')->after('meta_keyword')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    public function down()
    {
        Schema::table('categories', function($table) {
            $table->dropColumn('meta_title')->after('status');
            $table->dropColumn('meta_keyword');
            $table->dropColumn('meta_description');
        });
    }
}
