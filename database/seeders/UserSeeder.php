<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create demo users
        $member = User::factory()->create([
            "name"  => "Example member user",
            "email" => "member@example.com"
        ]);
        $member->assignRole(['member']);

        $admin = User::factory()->create([
            "name"  => "Example admin user",
            "email" => "admin@example.com"
        ]);
        $admin->assignRole(['admin']);

        $superAdmin = User::factory()->create([
            "name"  => "Example super-admin user",
            "email" => "super-admin@example.com"
        ]);
        $superAdmin->assignRole(['super-admin']);
    }
}
