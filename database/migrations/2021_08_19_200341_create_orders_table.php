<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->default(1);
            $table->string('customer_id')->comment('user who buy the product');
            $table->integer('price');
            $table->integer('commission')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('coupon_id')->default(0);
            $table->dateTime('order_date_time');
            $table->boolean('is_delivered')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
