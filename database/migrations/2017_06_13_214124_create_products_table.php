<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('clave');
            //$table->string('name', 20)->unique()->default('NULL');
            $table->string('description', 50);
            $table->string('weigth')->nullable();
            $table->string('observations', 50)->nullable();
            $table->double('price');
            $table->double('price_purchase');
            $table->double('discount');
            $table->integer('discar_cause')->nullable();
            $table->string('image')->default('https://x.kinja-static.com/assets/images/logos/placeholders/default.png'); 

            $table->integer('category_id')->unsigned(); 
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('line_id')->unsigned()->nullable();
            $table->foreign('line_id')->references('id')->on('lines')->onDelete('cascade');

            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');

            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->date('date_creation', 25);

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->date('sold_at')->nullable();
            $table->date('discarded_at')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('product_images');
    }
}
