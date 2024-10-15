<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); // Uncomment this line if you want to create dummy users

        $this->call([
            DepartmentsTableSeeder::class,
            FilesTableSeeder::class, // Add the FilesTableSeeder here
            // Add other seeders if needed
        ]);
    }
}
