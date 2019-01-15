<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodeVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_vouchers', function (Blueprint $table) {
            $table->string('code')->unique();
            $table->integer('voucher_id');
            $table->integer('manufacturer_id')->nullable();
            $table->integer('member_id')->nullable();

            $table->timestamps();
            $table->engine = 'MyISAM';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('code_vouchers');
    }
}
