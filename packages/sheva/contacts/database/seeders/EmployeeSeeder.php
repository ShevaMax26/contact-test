<?php

namespace Sheva\Contacts\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Sheva\Contacts\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Oleg',
                'surname' => 'Voytuk',
            ],
            [
                'name' => 'Maxym',
                'surname' => 'Shevchuk',
            ],
            [
                'name' => 'Anna',
                'surname' => 'Koval',
            ],
            [
                'name' => 'Ivan',
                'surname' => 'Petrov',
            ],
            [
                'name' => 'Olga',
                'surname' => 'Ivanova',
            ],
            [
                'name' => 'Pavel',
                'surname' => 'Sidorov',
            ],
            [
                'name' => 'Elena',
                'surname' => 'Kuznetsova',
            ],
            [
                'name' => 'Dmitry',
                'surname' => 'Popov',
            ],
            [
                'name' => 'Svetlana',
                'surname' => 'Sokolova',
            ],
            [
                'name' => 'Andrey',
                'surname' => 'Novikov',
            ],
            [
                'name' => 'Natalia',
                'surname' => 'Fedorova',
            ],
            [
                'name' => 'Alexey',
                'surname' => 'Mironov',
            ],
            [
                'name' => 'Marina',
                'surname' => 'Morozova',
            ],
            [
                'name' => 'Sergey',
                'surname' => 'Bogdanov',
            ],
            [
                'name' => 'Yulia',
                'surname' => 'Volkova',
            ],
            [
                'name' => 'Roman',
                'surname' => 'Kozlov',
            ],
            [
                'name' => 'Elena',
                'surname' => 'Golubeva',
            ],
            [
                'name' => 'Igor',
                'surname' => 'Smirnov',
            ],
            [
                'name' => 'Tatiana',
                'surname' => 'Kudryavtseva',
            ],
            [
                'name' => 'Vladimir',
                'surname' => 'Orlov',
            ],
            [
                'name' => 'Ekaterina',
                'surname' => 'Vlasova',
            ],
            [
                'name' => 'Anton',
                'surname' => 'Prokhorov',
            ],
            [
                'name' => 'Nina',
                'surname' => 'Pavlova',
            ],
            [
                'name' => 'Dmitry',
                'surname' => 'Sorokin',
            ],
            [
                'name' => 'Raisa',
                'surname' => 'Fedorova',
            ],
            [
                'name' => 'Viktor',
                'surname' => 'Belyaev',
            ],
            [
                'name' => 'Evgenia',
                'surname' => 'Semyonova',
            ],
            [
                'name' => 'Vitaly',
                'surname' => 'Bogdanov',
            ],
            [
                'name' => 'Ludmila',
                'surname' => 'Kuznetsova',
            ],
            [
                'name' => 'Ivan',
                'surname' => 'Nikolaev',
            ],
            [
                'name' => 'Lyudmila',
                'surname' => 'Vorobeva',
            ],
            [
                'name' => 'Artem',
                'surname' => 'Nikitin',
            ],
            [
                'name' => 'Nina',
                'surname' => 'Popova',
            ],
            [
                'name' => 'Sergey',
                'surname' => 'Ponomarev',
            ],
            [
                'name' => 'Raisa',
                'surname' => 'Frolova',
            ],
            [
                'name' => 'Oleg',
                'surname' => 'Filatov',
            ],
            [
                'name' => 'Elena',
                'surname' => 'Petrova',
            ],
            [
                'name' => 'Pavel',
                'surname' => 'Sokolov',
            ],
            [
                'name' => 'Larisa',
                'surname' => 'Fedorova',
            ],
            [
                'name' => 'Nikolay',
                'surname' => 'Makarov',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::firstOrCreate($employee);
        }

        for ($i = 1; $i <= 100; $i++) {
            Employee::create([
                'name' => fake()->firstName(),
                'surname' => fake()->lastName(),
            ]);
        }
    }
}
