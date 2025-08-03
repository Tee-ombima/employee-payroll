@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4 sm:py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl font-bold">Payroll History for {{ $employee->name }}</h1>
        <a href="{{ route('employees.show', $employee) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            ← Back to Employee
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pay Period</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gross Salary</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Deductions</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Salary</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($records as $record)
                <tr>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->pay_period->format('F Y') }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">KES {{ number_format($record->gross_salary, 2) }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">KES {{ number_format($record->total_deductions, 2) }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">KES {{ number_format($record->net_salary, 2) }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('payslip.download', $record) }}" class="text-blue-600 hover:text-blue-900">
    Download
</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $records->links() }}
    </div>
</div>
@endsection