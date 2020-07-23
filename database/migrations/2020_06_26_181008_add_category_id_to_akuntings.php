<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToAkuntings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akuntings', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned()->after('description');

            $table->foreign('category_id')->references('id')->on('category_transaksis');
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
