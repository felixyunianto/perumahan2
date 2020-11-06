<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewSubSubCategoryToAkuntings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akuntings', function (Blueprint $table) {
            $table->bigInteger('sub_sub_category_id')->unsigned()->after('sub_category_id')->nullable();

            $table->foreign('sub_sub_category_id')->references('id')->on('sub_sub_categories')->onDelete('CASCADE');
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
