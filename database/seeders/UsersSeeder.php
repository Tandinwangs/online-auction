<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Retrieve existing roles
         $adminRole = Role::where('name', 'admin')->first();
         $userRole = Role::where('name', 'user')->first();

          // Create admin user
        $admin = User::create([
            'name' => 'Tandin Wangchuk',
            'email' => 'wangchuktandin@bnb.bt',
            'cid' => '11510000467',
            'password' => Hash::make('T@ndin123')
        ]);

        $admin->assignRole($adminRole);
    }
}
