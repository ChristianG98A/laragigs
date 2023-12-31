<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            "name" => "John Doe",
            "email" => "john@doe.com"
        ]);

        $admin = User::factory()->create([
            "name" => "cristi",
            "email" => "cristi.hva@gmail.com",
            "role" => "admin"
        ]);

        \App\Models\User::factory(10)->create();

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

    }
}
