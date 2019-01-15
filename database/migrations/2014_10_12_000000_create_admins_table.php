<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->timestamp('last_login')->nullable();
            $table->string('name');
            $table->integer('area_id');
            $table->integer('role_id');
            $table->string('phone')->nullable();
            $table->string('lang')->default('vi');
            $table->string('avatar')->nullable();
            $table->boolean('gender')->default(1);
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
