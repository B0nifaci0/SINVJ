<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('date_upload');
            $table->integer('expenses_id')->unsigned();
            $table->foreign('expenses_id')->references('id')->on('expenses')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_images');
    }
}
