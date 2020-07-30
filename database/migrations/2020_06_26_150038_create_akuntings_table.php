<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkuntingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akuntings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->date('date');
            $table->boolean('status');
            $table->string('description')->nullable();
            $table->bigInteger('id_customer')->unsigned()->nullable();
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
        Schema::dropIfExists('akuntings');
    }
}
