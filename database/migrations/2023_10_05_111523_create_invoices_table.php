<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(); // user
            $table->foreignId('store_id')->nullable(); // store
            $table->foreignId('customer_id')->nullable(); // store

            
            $table->longText('invoice_number')->nullable();

            $table->string('currency')->nullable();

            $table->longText('note')->nullable();

            $table->date('due_at')->nullable();
            $table->date('paid_at')->nullable();
            $table->date('sent_at')->nullable();
            

            $table->boolean('is_recurring')->default(0); // will have an entry in invoice schedule table

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
        Schema::dropIfExists('invoices');
    }
};
