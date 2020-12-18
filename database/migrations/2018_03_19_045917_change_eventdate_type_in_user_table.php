<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEventdateTypeInUserTable extends Migration
{



    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        * Unknown database type enum requested, Doctrine\DBAL\Platforms\MySqlPlatform may not support it. 
        */
        Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        
        Schema::table('users',function($table){
            $table->date('event_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function($table){
           $table->string('event_date',255)->nullable()->change();
        });
    }
}
