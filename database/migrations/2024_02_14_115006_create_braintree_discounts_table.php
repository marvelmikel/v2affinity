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
        Schema::create('braintree_discounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount')->nullable();
            $table->string('name')->nullable();
            $table->string('discount_id')->nullable();
            $table->string('merchant_id')->nullable();
            $table->integer('current_billing_cycle')->nullable();
            $table->longText('description')->nullable();
            $table->string('kind')->nullable();
            $table->boolean('never_expires')->nullable();
            $table->integer('number_of_billing_cycles')->nullable();
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
        Schema::dropIfExists('braintree_discounts');
    }
};
