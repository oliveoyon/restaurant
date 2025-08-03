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
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('account_type_hash_id');
            $table->foreignId('account_head_id')->nullable()->constrained()->onDelete('cascade')->default(0);
            $table->string('account_name');
            $table->boolean('is_money')->default(false);
            $table->boolean('is_wallet')->default(false);
            $table->integer('store_id');
            $table->integer('acctype_status');
            $table->integer('code');
            $table->string('acc_type');
            $table->integer('normal');
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
        Schema::dropIfExists('account_types');
    }
};
