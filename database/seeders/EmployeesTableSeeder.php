<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\PayrollRecord;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        $departments = ['Finance', 'HR', 'IT', 'Operations', 'Marketing'];
        $positions = [
            'Manager' => ['min_salary' => 80000, 'max_salary' => 150000],
            'Officer' => ['min_salary' => 50000, 'max_salary' => 90000],
            'Assistant' => ['min_salary' => 30000, 'max_salary' => 60000],
            'Director' => ['min_salary' => 120000, 'max_salary' => 250000],
            'Clerk' => ['min_salary' => 25000, 'max_salary' => 45000]
        ];
        
        for ($i = 1; $i <= 20; $i++) {
            $position = array_rand($positions);
            $salaryRange = $positions[$position];
            $grossSalary = mt_rand($salaryRange['min_salary'], $salaryRange['max_salary']);
            $hireDate = Carbon::now()->subMonths(mt_rand(1, 60));
            
            $employee = Employee::create([
                'employee_id' => 'EMP-' . strtoupper(Str::random(6)),
                'name' => $this->generateName(),
                'email' => fake()->unique()->safeEmail,
                'phone' => '07' . mt_rand(10, 99) . mt_rand(100000, 999999),
                'position' => $position,
                'department' => $departments[array_rand($departments)],
                'gross_salary' => $grossSalary,
                'hire_date' => $hireDate->format('Y-m-d'),
            ]);

            // Generate payroll history for this employee
            $this->generatePayrollHistory($employee, $hireDate, $grossSalary);
        }
    }
    
    protected function generateName()
    {
        $firstNames = ['John', 'Jane', 'David', 'Sarah', 'Michael', 'Emily', 'Robert', 'Lisa', 'James', 'Mary'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Miller', 'Davis', 'Garcia', 'Rodriguez', 'Wilson'];
        
        return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
    }

    protected function generatePayrollHistory($employee, $hireDate, $baseSalary)
    {
        $monthsEmployed = $hireDate->diffInMonths(now());
        $payPeriods = min($monthsEmployed, 12); // Max 12 months of history
        
        for ($i = 0; $i < $payPeriods; $i++) {
            $payPeriod = now()->subMonths($i);
            $salaryVariation = mt_rand(-5, 5) * 500; // Random salary variation of ±2500
            
            // Ensure salary doesn't go below minimum wage
            $grossSalary = max($baseSalary + $salaryVariation, 15000);
            
            // Calculate deductions
            $paye = $this->calculatePAYE($grossSalary);
            $shif = $this->calculateSHIF($grossSalary);
            $nssf = $this->calculateNSSF($grossSalary);
            
            $totalDeductions = $paye + $shif + $nssf;
            $netSalary = $grossSalary - $totalDeductions;
            
            PayrollRecord::create([
                'employee_id' => $employee->id,
                'pay_period' => $payPeriod->format('Y-m-d'),
                'gross_salary' => $grossSalary,
                'paye' => $paye,
                'shif' => $shif,
                'nssf' => $nssf,
                'total_deductions' => $totalDeductions,
                'net_salary' => $netSalary,
                'created_at' => $payPeriod,
                'updated_at' => $payPeriod
            ]);
        }
    }

    protected function calculatePAYE(float $grossSalary): float
    {
        $annualRelief = 28800; // Personal relief (2400/month × 12)
        $annualTaxable = ($grossSalary * 12) - $annualRelief;
        
        // Monthly taxable amount
        $monthlyTaxable = $annualTaxable / 12;

        // Kenyan 2023 tax bands (monthly)
        if ($monthlyTaxable <= 24000) {
            return $monthlyTaxable * 0.10;
        } elseif ($monthlyTaxable <= 32333) {
            return 2400 + ($monthlyTaxable - 24000) * 0.25;
        } else {
            return 4483 + ($monthlyTaxable - 32333) * 0.30;
        }
    }

    protected function calculateSHIF(float $grossSalary): float
    {
        $rates = [
            5999 => 150,
            7999 => 300,
            11999 => 400,
            14999 => 500,
            19999 => 600,
            24999 => 750,
            29999 => 850,
            34999 => 900,
            39999 => 950,
            44999 => 1000,
            49999 => 1100,
            59999 => 1200,
            69999 => 1300,
            79999 => 1400,
            89999 => 1500,
            99999 => 1600,
            PHP_INT_MAX => 1700
        ];

        foreach ($rates as $limit => $contribution) {
            if ($grossSalary <= $limit) {
                return (float) $contribution;
            }
        }

        return 0.0;
    }

    protected function calculateNSSF(float $grossSalary): float
    {
        $tierI = 200; // Fixed amount
        $tierII = min($grossSalary, 18000) * 0.06; // 6% of pensionable earnings (capped at 18,000)
        return $tierI + $tierII;
    }
}