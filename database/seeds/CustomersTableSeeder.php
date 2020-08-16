<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Customer::create([
            'name' => 'Customer Pertama',
            'NIK' => 1234567890,
            'address' => 'Jl. Customer Pertama',
            'email' => 'customerpertama@gmail.com',
            'no_hp' => '09876556789',
            'job_status' => 'Pegawai',
            'user_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        App\Customer::create([
            'name' => 'Customer Kedua',
            'NIK' => '0987654334567',
            'address' => 'Jl. Customer Kedua',
            'email' => 'customerkedua@gmail.com',
            'no_hp' => '08678876544',
            'job_status' => 'Pegawai',
            'user_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        App\Customer::create([
            'name' => 'Customer Ketiga',
            'NIK' => '09876748742512',
            'address' => 'Jl. Customer Ketiga',
            'email' => 'customerketiga@gmail.com',
            'no_hp' => '086475684658',
            'job_status' => 'Pegawai',
            'user_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
