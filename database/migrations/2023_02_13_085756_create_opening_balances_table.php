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
        Schema::create('opening_balances', function (Blueprint $table) {
            $table->id();
            $table->string('ob_hash_id', 100)->unique();
            $table->string('invoice_no', 200);
            $table->string('category', 20);
            $table->string('description', 200);
            $table->integer('account_id');
            $table->unsignedBigInteger('amount')->default(0);
            $table->dateTime('entry_date')->nullable();
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
        Schema::dropIfExists('opening_balances');
    }
};
