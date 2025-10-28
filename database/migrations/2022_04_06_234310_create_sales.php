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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_cd');
            $table->string('customer_id')->default(1);
            $table->integer('sale_amount')->default(0);
            $table->datetime('sale_at');
            $table->string('handover_method')->default('direct');
            $table->datetime('handover_at')->nullable();
            $table->string('payment_status')->default('waiting');
            $table->string('sale_status')->default('draft');
            $table->text('note')->nullable();
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
};
