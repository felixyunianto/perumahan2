<?php

use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Block::create([
            'name_block' => 'Perumahan OASE 1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\Block::create([
            'name_block' => 'Perumahan OASE 2',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\Block::create([
            'name_block' => 'Perumahan OASE 2',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\House::create([
            'name' => 'Blok A1',
            'address' => 'Jl. Perumahan OASE 1 blok A1',
            'price' => 200000000,
            'block_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\House::create([
            'name' => 'Blok A2',
            'address' => 'Jl. Perumahan OASE 1 blok A2',
            'price' => 200000000,
            'block_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\House::create([
            'name' => 'Blok A3',
            'address' => 'Jl. Perumahan OASE 1 blok A3',
            'price' => 198000000,
            'block_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\House::create([
            'name' => 'Blok A4',
            'address' => 'Jl. Perumahan OASE 1 blok A4',
            'price' => 198000000,
            'block_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
