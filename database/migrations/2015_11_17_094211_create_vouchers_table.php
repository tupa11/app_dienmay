<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->integer('manufacturer_id')->nullable();
            $table->integer('time_use');
            $table->tinyInteger('number_code');
            $table->integer('time_start')->default(strtotime(date('Y-m-d')));
            $table->integer('time_end')->default(strtotime(date('Y-m-d')));
            $table->string('img');
            $table->text('detail')->nullable();

            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vouchers');
    }
}
