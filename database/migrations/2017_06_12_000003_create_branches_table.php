<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
<<<<<<< HEAD
            $table->string('name_legal_re', 150);
            $table->string('email', 255);
            $table->string('other', 250);
            $table->string('rfc', 250);
            $table->integer('phone_number');
            $table->string('address', 255);
=======
            $table->string('name_legal_re');
            $table->string('email');
            $table->string('other');
            $table->string('rfc');
            $table->integer('phone_number');
            $table->string('address');
>>>>>>> 8599d250ca1a8f36801a989e503a3d209b4b741c
            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
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
        Schema::dropIfExists('branches');
    }
}
