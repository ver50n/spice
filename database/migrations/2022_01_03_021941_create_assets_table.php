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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id');
            $table->string('purchase_cd')->nullable();
            $table->string('asset_cd');
            $table->string('asset_category');
            $table->string('asset_name');
            $table->integer('initial_price')->default(0);
            $table->integer('current_price')->default(0);
            $table->integer('lifespan')->default(12);
            $table->date('purchase_dt')->nullable();
            $table->date('expire_dt')->nullable();
            $table->text('desc')->nullable();
            $table->string('asset_status');
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
        Schema::dropIfExists('assets');
    }
};
