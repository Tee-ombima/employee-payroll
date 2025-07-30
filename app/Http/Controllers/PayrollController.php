<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $statutoryDeductions = Deduction::where('is_statutory', true)->get();
        $customDeductions = Deduction::where('is_statutory', false)->get();
        
        return view('payroll.index', compact('statutoryDeductions', 'customDeductions'));
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

        return redirect()->route('payroll.index')
            ->with('success', 'Deductions updated successfully!');
    }
}