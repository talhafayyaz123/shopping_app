<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
             $table->id();
             $table->Integer('customer_id')->index();
             $table->string('address')->nullable();
             $table->Integer('country_id')->default(0);
             $table->string('city')->nullable();
             $table->string('zip')->nullable();
             $table->string('country')->nullable();
             $table->enum('status', ['Active', 'Inactive']);
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
        Schema::dropIfExists('addresses');
    }
}
