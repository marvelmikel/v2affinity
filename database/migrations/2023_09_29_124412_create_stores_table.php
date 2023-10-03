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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('store_name');
            $table->bigInteger('next_invoice_number')->default(1);
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('address_city');
            $table->string('address_county')->nullable();
            $table->string('address_country');
            $table->string('address_postcode');
            $table->string('store_email')->nullable();
            $table->string('store_phone')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
