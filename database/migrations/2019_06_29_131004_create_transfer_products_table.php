<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('last_branch_id')->unsigned();
            $table->foreign('last_branch_id')->references('id')->on('branches');
            $table->integer('new_branch_id')->unsigned();
            $table->foreign('new_branch_id')->references('id')->on('branches');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('destination_user_id')->unsigned();
            $table->foreign('destination_user_id')->references('id')->on('users');
            $table->boolean('status_product');
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
        Schema::dropIfExists('transfer_products');
    }
}
