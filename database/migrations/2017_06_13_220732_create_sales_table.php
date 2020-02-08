<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name', 50)->nullable();
            $table->string('telephone')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->double('total', 9, 2);
            $table->double('income', 9, 2);
            $table->double('change', 9, 2);
            $table->integer('folio');
            $table->double('paid_out');
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
        Schema::dropIfExists('sales');
    }
}
