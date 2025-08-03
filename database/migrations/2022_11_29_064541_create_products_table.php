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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_hash_id');
            $table->string('barcode');
            $table->foreignId('manufacturer_id')->nullable()->constrained()->onDelete('cascade')->default(0);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade')->default(0);
            $table->string('product_title');
            $table->string('title_slug');
            $table->longText('pdt_description')->nullable();
            $table->string('product_image')->nullable();
            $table->tinyInteger('product_status')->default(1);
            $table->bigInteger('total_quantity')->default(0);
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
        Schema::dropIfExists('products');
    }
};
