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
        Schema::create('batch', function (Blueprint $table) {
            $table->id();
            $table->string('batch_code');
            $table->string('batch_name');
            $table->string('year_create');
            $table->string('made_in');
            $table->string('description')->nullable();
            $table->integer('quantity_product');
            $table->integer('quantity_product_list');
            $table->string('batch_qrcode_verify');
            $table->string('batch_qrcode_access');
            $table->string('batch_qrcode_verify_img')->nullable();
            $table->string('batch_qrcode_access_img')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('batch');
    }
};
