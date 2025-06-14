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
        // for : wage, taxation, bonus
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_cd');
            $table->string('transaction_cd')->nullable();
            $table->string('expense_category');
            $table->string('expense_name');
            $table->integer('expense_amount')->default(0);
            $table->datetime('expense_at');
            $table->datetime('pay_at');
            $table->string('payment_status')->default('waiting');
            $table->string('expense_status')->default('draft');
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
        Schema::dropIfExists('expenses');
    }
};
