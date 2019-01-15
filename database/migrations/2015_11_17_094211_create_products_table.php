<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->integer('view')->default(0);
            $table->integer('product_image');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('price_new')->default(0)->nullable();
            $table->text('details')->nullable();
            $table->integer('category_id');
            $table->integer('color_id')->default(0)->nullable();
            $table->integer('size_id')->default(0)->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('is_main')->default(0);
            $table->date('sale_from')->nullable();
            $table->date('sale_to')->nullable();
//            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::drop('products');
    }
}
