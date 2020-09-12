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
                'name' => 'pelanggan' // 1
        ]);

        Permission::create([
                'name' => 'pemberkasan' // 2
        ]);

        Permission::create([
                'name' => 'akuntan' // 3
        ]);

        Permission::create([
                'name' => 'user' // 4
        ]);

        Permission::create([
                'name' => 'role' // 5
        ]);

        Permission::create([
                'name' => 'block' // 6
        ]);

        Permission::create([
                'name' => 'house' // 7
        ]);

        $marketing = Role::where('name', 'marketing')->first();
        $marketing->permissions()->attach([1,2,6,7]);

        $pemberkasan = Role::where('name', 'pemberkasan')->first();
        $pemberkasan->permissions()->attach([1,2,6,7]);

        $akuntan = Role::where('name', 'akuntansi')->first();
        $akuntan->permissions()->attach([3]);
        
        $admin = Role::where('name', 'admin')->first();
        $admin->permissions()->attach([1,2,3,4,5,6,7]);

        


    }
}
