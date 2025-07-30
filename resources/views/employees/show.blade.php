@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $employee->name }}</h1>
            <p class="text-gray-600">{{ $employee->position }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('employees.edit', $employee) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
<a href="{{ route('employees.payslip', $employee) }}" 
   class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
    Generate Payslip
</a>        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <h2 class="text-lg font-medium text-gray-800 mb-2">Personal Information</h2>
            <div class="space-y-2">
                <p><span class="font-medium text-gray-700">Employee ID:</span> {{ $employee->employee_id }}</p>
                <p><span class="font-medium text-gray-700">Email:</span> {{ $employee->email }}</p>
                <p><span class="font-medium text-gray-700">Phone:</span> {{ $employee->phone }}</p>
            </div>
        </div>
        
        <div>
            <h2 class="text-lg font-medium text-gray-800 mb-2">Employment Details</h2>
            <div class="space-y-2">
                <p><span class="font-medium text-gray-700">Department:</span> {{ $employee->department }}</p>
                <p><span class="font-medium text-gray-700">Hire Date:</span> 
    {{ \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') }}
</p>
                <p><span class="font-medium text-gray-700">Gross Salary:</span> KES {{ number_format($employee->gross_salary, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('employees.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Back to Employees
        </a>
    </div>
</div>
@endsection