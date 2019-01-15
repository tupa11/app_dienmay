<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vocher_id')->nullable();
            $table->string('img');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->engine = 'MyISAM';  //InnoDB
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
