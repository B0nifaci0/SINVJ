<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 15)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->integer('price');
            $table->string('image')->nullable();

            $table->integer('shoṕ_id')->unsigned()->nullable();
            $table->foreign('shoṕ_id')->references('id')->on('shops');
            
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('branch_id')->references('id')->on('branch');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('store_expenses');
    }
}
