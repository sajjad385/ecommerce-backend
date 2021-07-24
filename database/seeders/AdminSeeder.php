<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::unguard();
        $admins = [
            [
                'name' => 'Sajjad Hossain',
                'email' => 'sajjad@ecom.com',
                'password' => bcrypt('secret')
            ],
        ];
        foreach ($admins as $admin) {
            Admin::firstOrCreate(['email' => $admin['email']], $admin);
        }
        Admin::reguard();

    }
}
