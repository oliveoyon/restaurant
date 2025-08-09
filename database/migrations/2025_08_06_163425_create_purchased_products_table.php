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
    Schema::create('purchased_products', function (Blueprint $table) {
        $table->id();

        $table->string('invoice_no');                     // Purchase invoice number
        $table->string('product_type')->nullable();       // Optional type/category
        $table->unsignedBigInteger('product_id');         // FK to products
        $table->string('batch_no')->nullable();           // Batch number
        $table->unsignedBigInteger('supplier_id')->nullable();  // FK to suppliers
        $table->unsignedBigInteger('shelf_id')->nullable();     // FK to shelf/table if needed

        $table->unsignedBigInteger('tax_id')->nullable();       // Optional tax reference
        $table->decimal('tax_value_percent', 5, 2)->nullable(); // Tax percent

        $table->string('serial_no')->nullable();          // Optional serial
        $table->string('barcode')->nullable();            // Optional barcode
        $table->string('size')->nullable();               // Optional
        $table->string('color')->nullable();              // Optional

        $table->decimal('buy_price', 10, 2);              // Buying price
        $table->decimal('buy_price_with_tax', 10, 2)->nullable(); // Optional
        $table->decimal('sell_price', 10, 2)->nullable(); // Selling price
        $table->integer('quantity');                      // Quantity purchased

        $table->date('purchase_date')->nullable();        // Purchase date
        $table->date('expired_date')->nullable();         // Expiry date (optional)

        $table->string('post_by')->nullable();            // Who posted the entry
        $table->unsignedBigInteger('store_id')->nullable(); // Store location

        $table->boolean('status')->default(1);            // Active/inactive
        $table->timestamps();                             // created_at, updated_at
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchased_products');
    }
};
