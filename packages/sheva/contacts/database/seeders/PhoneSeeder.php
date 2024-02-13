<?php

namespace Sheva\Contacts\Database\Seeders;

use Illuminate\Database\Seeder;
use Sheva\Contacts\Models\Employee;
use Sheva\Contacts\Models\Phone;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            for ($i = 0; $i < random_int(1, 3); $i++) {
                Phone::firstOrCreate([
                    'phone' => mt_rand(100000000, 999999999),
                    'employee_id' => $employee->id,
                ]);
            }
        }
    }
}
