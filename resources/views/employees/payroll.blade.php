@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Payroll for {{ $employee->name }}</h1>
        <a href="{{ route('employees.payslip.pdf', $employee) }}" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
            </svg>
            Download PDF
        </a>
    </div>

    <div class="mb-8">
        <h2 class="text-lg font-medium text-gray-800 mb-4">Salary Breakdown</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount (KES)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Gross Salary</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($grossSalary, 2) }}</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4 font-medium" colspan="2">Deductions</td>
                    </tr>
                    @foreach($deductionDetails as $deduction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $deduction['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($deduction['amount'], 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="bg-gray-100">
                        <td class="px-6 py-4 font-medium">Total Deductions</td>
                        <td class="px-6 py-4 font-medium">{{ number_format($totalDeductions, 2) }}</td>
                    </tr>
                    <tr class="bg-blue-50">
                        <td class="px-6 py-4 font-bold">Net Salary</td>
                        <td class="px-6 py-4 font-bold">{{ number_format($netSalary, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('employees.show', $employee) }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Back to Employee
        </a>
        <span class="text-sm text-gray-500">Generated on {{ now()->format('M d, Y H:i') }}</span>
    </div>
</div>
@endsection