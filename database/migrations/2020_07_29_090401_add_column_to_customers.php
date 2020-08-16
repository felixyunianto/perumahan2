<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->boolean('dp_status')->default(false)->after('utj_status');
            $table->boolean('sp3_status')->default(false)->after('dp_status');
            $table->boolean('lpa_status')->default(false)->after('sp3_status');
            $table->boolean('akad_status')->default(false)->after('lpa_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // $table->boolean('status_dp');
        });
    }
}
