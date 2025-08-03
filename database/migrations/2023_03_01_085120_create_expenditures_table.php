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
        Schema::create('expenditures', function (Blueprint $table) {
            $table->id();
            $table->string('expen_hash_id', 100)->unique();
            $table->string('invoice_no', 200);
            $table->integer('acc_head_id');
            $table->integer('employee_id')->default(0);
            $table->string('description', 200);
            $table->unsignedBigInteger('amount')->default(0);
            $table->dateTime('exp_date');
            $table->unsignedBigInteger('from_account')->default(0);
            $table->integer('expense_by');
            $table->integer('expense_status');
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
        Schema::dropIfExists('expenditures');
    }
};
