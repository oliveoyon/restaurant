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
        Schema::create('product_recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');      // Finished Product
            $table->foreignId('raw_product_id')->constrained('products')->onDelete('cascade');  // Raw Material
            $table->decimal('quantity', 15, 6);                                       // Quantity needed per unit
            $table->string('unit')->nullable();                                                // Unit e.g., gm, ml
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
        Schema::dropIfExists('product_recipes');
    }
};
