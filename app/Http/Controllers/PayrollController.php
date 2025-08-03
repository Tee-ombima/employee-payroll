<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;
use App\Models\Employee;
class PayrollController extends Controller
{
    public function index()
    {
        $statutoryDeductions = Deduction::where('is_statutory', true)->get();
        $customDeductions = Deduction::where('is_statutory', false)->get();
        
        // Calculate payroll summary using gross_salary directly from employees table
        $employees = Employee::all();
        
        $totalGross = $employees->sum('gross_salary');
        
        // Get deduction rates
        $kraRate = $statutoryDeductions->firstWhere('name', 'like', '%PAYE%')->amount ?? 0;
        $nssfRate = $statutoryDeductions->firstWhere('name', 'like', '%NSSF%')->amount ?? 0;
        $nhifRate = $statutoryDeductions->firstWhere('name', 'like', '%NHIF%')->amount ?? 0;
        
        // Calculate statutory deductions
        $kraAmount = 0;
        $nssfAmount = 0;
        $nhifAmount = 0;
        
        foreach ($employees as $employee) {
            $gross = $employee->gross_salary ?? 0;
            
            // Calculate PAYE (KRA) - simplified calculation
            $kraAmount += ($gross * $kraRate / 100);
            
            // Calculate NSSF - assuming flat rate
            $nssfAmount += ($gross * $nssfRate / 100);
            
            // Calculate NHIF - assuming flat rate
            $nhifAmount += ($gross * $nhifRate / 100);
        }
        
        $totalStatutory = $kraAmount + $nssfAmount + $nhifAmount;
        
        // Calculate total deductions (statutory + custom)
        $totalDeductions = $totalStatutory; // Add custom deductions if needed
        
        // Calculate net pay
        $totalNet = $totalGross - $totalDeductions;
        
        return view('payroll_deductions.index', compact(
            'statutoryDeductions',
            'customDeductions',
            'totalGross',
            'totalNet',
            'totalStatutory',
            'totalDeductions',
            'kraAmount',
            'nssfAmount',
            'nhifAmount'
        ));
    }

    public function updateDeductions(Request $request)
    {
        $validated = $request->validate([
            'deductions' => 'required|array',
            'deductions.*.id' => 'required|exists:deductions,id',
            'deductions.*.amount' => 'required|numeric|min:0',
        ]);

        foreach ($validated['deductions'] as $deductionData) {
            Deduction::where('id', $deductionData['id'])
                ->update(['amount' => $deductionData['amount']]);
        }

        return redirect()->route('payroll_deductions.index')
            ->with('success', 'Deductions updated successfully!');
    }
}