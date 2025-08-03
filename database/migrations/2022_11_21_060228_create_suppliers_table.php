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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_hash_id', 100)->unique();
            $table->string('supplier_name', 200);
            $table->string('supplier_address', 300)->nullable();
            $table->string('supplier_phone', 300)->nullable();
            $table->string('supplier_email', 100)->nullable();
            $table->integer('store_id');
            $table->boolean('supplier_status')->default(0);
            $table->integer('parent_id');
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
        Schema::dropIfExists('suppliers');
    }
};
