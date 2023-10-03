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
        /* Create plans table */
        Schema::create('plans', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('description');
            $table->double('price')->nullable();
            $table->string('currencyIsoCode', 3);
            $table->string('billingFrequency');
            $table->string('numberOfBillingCycles')->nullable();
            $table->string('trialPeriod')->nullable();
            $table->string('trialDuration')->nullable();
            $table->string('trialDurationUnit')->nullable();
            $table->json('addOns')->nullable();
            $table->json('discounts')->nullable();
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
        /* Drop plans table */
        Schema::dropIfExists('plans');
    }
};
