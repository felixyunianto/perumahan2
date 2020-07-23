<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
                'name' => 'pelanggan'
        ]);

        Permission::create([
                'name' => 'pemberkasan'
        ]);

        Permission::create([
                'name' => 'akuntan'
        ]);

        Permission::create([
                'name' => 'user'
        ]);

        Permission::create([
                'name' => 'role'
        ]);

        Permission::create([
                'name' => 'block'
        ]);

        Permission::create([
                'name' => 'house'
        ]);

        $marketing = Role::where('name', 'marketing')->first();
        $marketing->permissions()->attach([1]);

        $pemberkasan = Role::where('name', 'pemberkasan')->first();
        $pemberkasan->permissions()->attach([2]);
        
        $admin = Role::where('name', 'admin')->first();
        $admin->permissions()->attach([1,2,3,4,5,6,7]);

        


    }
}
