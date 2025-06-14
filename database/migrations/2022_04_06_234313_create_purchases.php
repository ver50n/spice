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
        // for : stock, asset
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_cd');
            $table->string('supplier_id')->default(1);
            $table->integer('purchase_amount')->default(0);
            $table->datetime('purchase_at');
            $table->datetime('handover_at')->nullable();
            $table->string('payment_status')->default('waiting');
            $table->string('purchase_status')->default('draft');
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
        Schema::dropIfExists('purchases');
    }
};
