<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_list', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('batch_id');
            $table->string('product_list_code');
            $table->string('product_list_name');
            $table->integer('quantity');
            $table->integer('quantity_s')->nullable();
            $table->integer('quantity_m')->nullable();
            $table->integer('quantity_l')->nullable();
            $table->integer('quantity_xl')->nullable();
            $table->integer('quantity_xxl')->nullable();
            $table->string('material');
            $table->string('description')->nullable();
            $table->string('product_list_img');
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
        Schema::dropIfExists('product_list');
    }
};
