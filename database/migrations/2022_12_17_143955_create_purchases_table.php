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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->string('invoice_no');
            $table->string('trns_type');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('total')->default(0);
            $table->unsignedBigInteger('due')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('paid')->default(0);
            $table->integer('purchase_status');
            $table->dateTime('purchase_date');
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
        Schema::dropIfExists('purchases');
    }
};
