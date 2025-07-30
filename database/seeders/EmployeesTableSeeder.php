<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Str;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $departments = ['Finance', 'HR', 'IT', 'Operations', 'Marketing'];
        $positions = ['Manager', 'Officer', 'Assistant', 'Director', 'Clerk'];
        
        for ($i = 1; $i <= 20; $i++) {
            Employee::create([
                'employee_id' => 'EMP-' . strtoupper(Str::random(6)),
                'name' => 'Employee ' . $i,
                'email' => 'employee' . $i . '@company.com',
                'phone' => '07' . mt_rand(10, 99) . mt_rand(100000, 999999),
                'position' => $positions[array_rand($positions)],
                'department' => $departments[array_rand($departments)],
                'gross_salary' => mt_rand(30000, 150000),
                'hire_date' => now()->subMonths(mt_rand(1, 60))->format('Y-m-d'),
            ]);
        }
    }
}
