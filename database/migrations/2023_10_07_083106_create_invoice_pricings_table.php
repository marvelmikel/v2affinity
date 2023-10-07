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
        Schema::create('invoice_pricings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')->nullable();
            $table->string('name')->nullable(); // example: subtotal
            $table->string('value')->nullable();
            $table->string('identifier')->unique(); // P471 
            

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
        Schema::dropIfExists('invoice_pricings');
    }
};
