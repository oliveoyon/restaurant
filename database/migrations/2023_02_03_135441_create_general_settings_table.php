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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_hash_id', 100)->unique();
            $table->string('company_title', 200);
            $table->string('company_title_bn', 200);
            $table->string('company_email', 200);
            $table->string('company_phone', 200);
            $table->string('company_phone1', 200);
            $table->string('company_phone2', 200);
            $table->string('company_fax', 200);
            $table->string('company_address', 200);
            $table->string('company_country', 200);
            $table->string('company_currency', 200);
            $table->string('company_currency_sign', 200);
            $table->string('company_facebook', 200);
            $table->string('company_twitter', 200);
            $table->string('company_google', 200);
            $table->string('company_linkedin', 200);
            $table->string('company_youtube', 200);
            $table->string('company_copyright', 200);
            $table->string('company_logo', 200);
            $table->integer('store_id');
            $table->integer('company_status');
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
        Schema::dropIfExists('general_settings');
    }
};
