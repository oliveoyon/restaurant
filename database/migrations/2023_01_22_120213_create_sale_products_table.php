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
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->string('sale_hash_id', 100)->unique();
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('pdtstock_id');
            $table->double('quantity')->default(0);
            $table->double('rate')->default(0);
            $table->string('invoice_no', 200);
            $table->integer('sale_by');
            $table->integer('store_id');
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
        Schema::dropIfExists('sale_products');
    }
};
