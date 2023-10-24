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

        Schema::create('product_metas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->string('visibility')->nullable(); // readonly, hidden, default
            $table->string('type')->nullable()->default('text'); // type = text, number, formular
            $table->string('identifier')->unique(); // PM41, PM54 - ProductMeta where the number corresponds to the product_id and product_meta_id 
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
        Schema::dropIfExists('product_metas');
    }
};
