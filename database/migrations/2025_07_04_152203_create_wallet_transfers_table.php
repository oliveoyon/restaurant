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
        Schema::create('wallet_transfers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('account_type_id');
            $table->string('wallet_name', 50);

            $table->date('transfer_date');

            $table->decimal('gross_amount', 15, 2);
            $table->decimal('fee_percentage', 5, 2);
            $table->decimal('fee_amount', 15, 2);
            $table->decimal('net_amount', 15, 2);

            $table->string('bank_account', 100)->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->foreign('account_type_id')
                ->references('id')->on('account_types')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transfers');
    }
};
