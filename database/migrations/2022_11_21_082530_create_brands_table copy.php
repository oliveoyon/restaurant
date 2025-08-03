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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_hash_id', 100)->unique();
            $table->string('brand_name', 200);
            $table->string('brand_address', 300)->nullable();
            $table->string('brand_phone', 300)->nullable();
            $table->string('brand_email', 100)->nullable();
            $table->integer('store_id');
            $table->boolean('brand_status')->default(0);
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
        Schema::dropIfExists('brands');
    }
};
