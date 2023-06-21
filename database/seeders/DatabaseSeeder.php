<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // DB::table('users')->insert([
        //     'email' => "admin@gmail.com",
        //     'password' => Hash::make('admin')
        // ]);
        DB::table('roles')->insert([
            "name_role" => "member"
        ]);
        // DB::table("user_roles")->insert([
        //     "user_id" => 1,
        //     "role_id" => 1
        // ]);
        // DB::table("profiles")->insert([
        //     "user_id" => 1,
        //     'name'=>'nguyendangduy'
        // ]);
    }
}
