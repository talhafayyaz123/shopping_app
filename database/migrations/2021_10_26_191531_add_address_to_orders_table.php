<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
           $table->string('order_address')->nullable();
           $table->string('city')->nullable();
           $table->string('zip')->nullable();
           $table->string('country')->nullable();
           $table->enum('status',['Delivered','Dispatched','Pending']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
           $table->string('order_address');
           $table->string('city');
           $table->string('zip');
           $table->string('country');
           $table->string('status');
        });
    }
}
