<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->default(1);
            $table->integer('parent_id')->nullable();
            $table->integer('level')->nullable();
            $table->integer('category_order')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('short_description')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('update_by')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
