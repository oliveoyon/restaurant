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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('batch_no')->nullable(); // links to product_stocks.id
            $table->decimal('quantity_deducted', 10, 3); // stock out quantity
            $table->string('reason')->nullable(); // e.g., 'sale', 'adjustment', 'manufactured_sale'
            $table->unsignedBigInteger('store_id');
            $table->string('reference')->nullable(); // e.g., invoice number
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
        Schema::dropIfExists('stock_movements');
    }
};
