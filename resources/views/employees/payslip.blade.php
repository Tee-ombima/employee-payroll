@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">PAYSLIP</h1>
            <p class="text-gray-600">{{ $payPeriod }}</p>
        </div>
        <div class="text-right">
            <p class="font-bold">{{ config('app.name') }}</p>
            <p class="text-sm text-gray-600">Generated on: {{ $payDate }}</p>
        </div>
    </div>
    
    <div class="mb-8">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <p class="font-bold">Employee ID:</p>
                <p>{{ $employee->employee_id }}</p>
            </div>
            <div>
                <p class="font-bold">Employee Name:</p>
                <p>{{ $employee->name }}</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="font-bold">Department:</p>
                <p>{{ $employee->department }}</p>
            </div>
            <div>
                <p class="font-bold">Position:</p>
                <p>{{ $employee->position }}</p>
            </div>
        </div>
    </div>
    
    <div class="mb-8">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 text-left border">Description</th>
                    <th class="py-2 px-4 text-right border">Amount (KES)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border">Basic Salary</td>
                    <td class="py-2 px-4 text-right border">{{ number_format($payrollRecord->gross_salary, 2) }}</td>
                </tr>
                
                <!-- Deductions -->
                <tr class="bg-gray-50">
                    <td class="py-2 px-4 font-bold border">Deductions</td>
                    <td class="py-2 px-4 text-right border"></td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border">PAYE</td>
                    <td class="py-2 px-4 text-right border">{{ number_format($payrollRecord->paye, 2) }}</td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border">SHIF</td>
                    <td class="py-2 px-4 text-right border">{{ number_format($payrollRecord->shif, 2) }}</td>
                </tr>
                
                <tr>
                    <td class="py-2 px-4 border">NSSF</td>
                    <td class="py-2 px-4 text-right border">{{ number_format($payrollRecord->nssf, 2) }}</td>
                </tr>
                
                <!-- Totals -->
                <tr class="bg-gray-50 font-bold">
                    <td class="py-2 px-4 border">Total Deductions</td>
                    <td class="py-2 px-4 text-right border">{{ number_format($payrollRecord->total_deductions, 2) }}</td>
                </tr>
                <tr class="bg-blue-50 font-bold text-lg">
                    <td class="py-2 px-4 border">Net Salary</td>
                    <td class="py-2 px-4 text-right border">{{ number_format($payrollRecord->net_salary, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="grid grid-cols-2 gap-8 mt-12">
        <div class="text-center">
            <p class="border-t-2 border-gray-400 pt-2 inline-block">Employer Signature</p>
        </div>
        <div class="text-center">
            <p class="border-t-2 border-gray-400 pt-2 inline-block">Authorized Signature</p>
        </div>
    </div>
</div>
@endsection