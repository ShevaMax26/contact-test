<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Sheva\Contacts\Database\Seeders\EmployeeSeeder;
use Sheva\Contacts\Database\Seeders\PhoneSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmployeeSeeder::class,
            PhoneSeeder::class,
        ]);
    }
}
