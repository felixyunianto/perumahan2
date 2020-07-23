<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->integer('price');
            $table->bigInteger('block_id')->unsigned();
            $table->boolean('status')->default(false);
            $table->enum('status_process', ['Akad','Kosong','ACC','Proses','Cash'])->default('Kosong');
            $table->timestamps();

            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('CASCADE');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
