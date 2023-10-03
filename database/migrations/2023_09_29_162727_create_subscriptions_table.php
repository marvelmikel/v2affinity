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
        /* Create subscriptions table */
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id');
            $table->string('plan_id');
            $table->double('balance')->default(0.00);
            $table->unsignedTinyInteger('billingDayOfMonth')->default(1);
            $table->timestamp('firstBillingDate');
            $table->timestamp('nextBillingDate');
            $table->timestamp('billingPeriodStartDate')->nullable();
            $table->timestamp('billingPeriodEndDate')->nullable();
            $table->timestamp('paidThroughDate')->nullable();
            $table->unsignedSmallInteger('currentBillingCycle');
            $table->unsignedSmallInteger('numberOfBillingCycles')->nullable();
            $table->boolean('neverExpires')->default(0);
            $table->unsignedTinyInteger('daysPastDue')->nullable();
            $table->unsignedTinyInteger('failureCount')->nullable();
            $table->json('addOns')->nullable();
            $table->json('discounts')->nullable();
            $table->string('status');
            $table->json('statusHistory');
            $table->json('transactions');
            $table->timestamps();

            /* Constrain plan_id */
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
