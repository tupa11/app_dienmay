<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->string('email')->nullable();
            $table->integer('level')->default(1);
            $table->string('address')->nullable();
            $table->date('last_login')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->integer('area_id');
            $table->integer('admin_id');
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('members');
    }
}
