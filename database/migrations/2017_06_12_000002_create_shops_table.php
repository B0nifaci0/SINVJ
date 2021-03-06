<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 15);
            $table->string('image')->default('NULL');
            $table->string('description')->default('NULL');
            $table->string('email')->default('NULL');
            $table->string('phone_number')->default('NULL');
            $table->string('password')->nullable();

            $table->integer('shop_group_id')->unsigned()->nullable();
            $table->foreign('shop_group_id')->references('id')->on('shop_groups');

            $table->integer('municipality_id')->unsigned();
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states');
            
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
        Schema::dropIfExists('shops');
    }
}
