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
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('pdt_stock_hash_id');
            $table->string('invoice_no')->nullable();
            $table->string('product_type')->nullable();
            $table->string('barcode');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade')->default(0);
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('cascade')->default(0);
            $table->integer('shelf_id')->nullable();
            $table->string('serial_no', 100)->nullable();
            $table->string('batch_no')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('stckpdt_image')->nullable();
            $table->string('quantity')->nullable();
            $table->unsignedBigInteger('buy_price')->default(0);
            $table->unsignedBigInteger('sell_price')->default(0);
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('expired_date')->nullable();
            $table->integer('post_by');
            $table->integer('store_id');
            $table->integer('pdtstk_status');
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
        Schema::dropIfExists('product_stocks');
    }
};
