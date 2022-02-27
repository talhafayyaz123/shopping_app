<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountPriceToOrdersMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_meta', function (Blueprint $table) {
            $table->integer('discount_price')->default(0);
            $table->bigInteger('variant_id')->unsigned()->index();
             $table->integer('product_qty')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_meta', function (Blueprint $table) {
            $table->integer('discount_price');
              $table->integer('variant_id');
              $table->integer('product_qty');
        });
    }
}
