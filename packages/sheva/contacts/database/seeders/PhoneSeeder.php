<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Phone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            Phone::factory([
                'employee_id' => $employee->id
            ])
                ->count(random_int(1, 3))
                ->create();
        }
    }
}
