<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('NIK');
            $table->string('address');
            $table->string('email');
            $table->string('no_hp', 20);
            $table->string('job_status');
            $table->boolean('file_status')->nullable()->default(false);
            $table->enum('transaction',['Cash', 'Proses'])->nullable();
            $table->date('utj_status')->nullable();
            $table->date('dp_status')->nullable();
            $table->date('sp3_status')->nullable();
            $table->date('lpa_status')->nullable();
            $table->date('akad_status')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
