<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAkuntings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akuntings', function (Blueprint $table) {
            $table->bigInteger('block_id')->unsigned()->nullable();
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
        Schema::table('akuntings', function (Blueprint $table) {
            //
        });
    }
}
