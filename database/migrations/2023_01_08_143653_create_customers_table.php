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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_hash_id', 100)->unique();
            $table->string('customer_name', 200);
            $table->string('customer_address', 300)->nullable();
            $table->string('customer_phone', 300)->nullable();
            $table->string('customer_email', 100)->nullable();
            $table->integer('store_id');
            $table->boolean('customer_status')->default(0);
            $table->integer('parent_id')->default(0);
            $table->boolean('is_walkin')->default(0);
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
        Schema::dropIfExists('customers');
    }
};
