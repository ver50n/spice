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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_category');
            $table->string('product_name');
            $table->string('purchase_price')->default('0');
            $table->string('sell_price')->default('0');
            $table->string('product_thumbnail');
            $table->text('product_desc')->nullable();
            $table->tinyInteger('is_sell_to_customer')->default('0');
            $table->tinyInteger('is_show_in_landing')->default('0');
            $table->tinyInteger('is_active')->default('0');
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
        Schema::dropIfExists('products');
    }
};
