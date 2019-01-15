<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->text('permissions')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('name');
        });

//        Schema::create('admin_role', function (Blueprint $table) {
//            $table->integer('admin_id')->unsigned();
//            $table->integer('role_id')->unsigned();
//
//            $table->engine = 'InnoDB';
//            $table->primary(['admin_id', 'role_id']);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
//        Schema::dropIfExists('admin_role');
    }
}
