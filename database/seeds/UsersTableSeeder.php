<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('12345678'),
            'role_id' => 1
        ]);
        
        App\User::create([
                'name' => 'Marketing',
                'email' => 'marketing@gmail.com',
                'username' => 'marketing',
                'password' => bcrypt('12345678'),
                'role_id' => 2
        ]);
        
        App\User::create([
                'name' => 'Pemberkasan',
                'email' => 'berkas@gmail.com',
                'username' => 'berkas',
                'password' => bcrypt('12345678'),
                'role_id' => 3
        ]);

        App\User::create([
            'name' => 'Akuntansi',
            'email' => 'akuntan@gmail.com',
            'username' => 'akuntan',
            'password' => bcrypt('12345678'),
            'role_id' => 4
    ]);
    }
}
