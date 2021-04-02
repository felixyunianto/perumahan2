<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('photos')->nullable();
            $table->string('fc_id_card')->nullable();
            $table->string('fc_family_card')->nullable();
            $table->string('fc_marriage_certificate')->nullable();
            $table->string('fc_taxpayer_identification')->nullable();
            $table->string('tax_status')->nullable();
            $table->string('income')->nullable();
            $table->string('current_account')->nullable();
            $table->string('saving')->nullable();
            $table->string('ls_havent_house')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filings');
    }
}
