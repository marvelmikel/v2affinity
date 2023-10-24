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
        Schema::create('invoice_item_metas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('invoice_item_id')->nullable();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            
            $table->string('visibility')->nullable(); // readonly, hidden, default
            $table->string('type')->nullable()->default('text'); // type = text, number, formular

            $table->string('identifier')->unique(); // IIM41, IIM54 - InvoiceItemMeta where the number corresponds to the invoice_item_id field
            
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
        Schema::dropIfExists('invoice_item_metas');
    }
};
