@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Employees</h1>
    <div class="flex justify-between items-center mb-6">
    <div class="flex space-x-4">
       <a href="{{ route('payroll.index') }}" 
           class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-md">
            Payroll Deductions Management
        </a>
        
    </div>
    <div class="flex space-x-4">
        <a href="{{ route('employees.generate-all-payslips') }}" 
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
            Generate All Payslips
        </a>
        
    </div>
    <div class="flex space-x-4">
        
        <a href="{{ route('employees.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
            Add Employee
        </a>
    </div>
</div>
</div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($employees as $employee)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">KES {{ number_format($employee->gross_salary, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                            <a href="{{ route('employees.show', $employee) }}" class="text-blue-500 hover:text-blue-700">View</a>
                            <a href="{{ route('employees.edit', $employee) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                            
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 flex items-center justify-between">
    <div class="text-sm text-gray-700">
        Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} entries
    </div>
    <div class="flex space-x-2">
        @if ($employees->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Previous</span>
        @else
            <a href="{{ $employees->previousPageUrl() }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Previous</a>
        @endif

        @foreach ($employees->getUrlRange(1, $employees->lastPage()) as $page => $url)
            @if ($page == $employees->currentPage())
                <span class="px-3 py-1 bg-blue-500 text-white rounded">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3 py-1 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-100">{{ $page }}</a>
            @endif
        @endforeach

        @if ($employees->hasMorePages())
            <a href="{{ $employees->nextPageUrl() }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next</a>
        @else
            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Next</span>
        @endif
    </div>
    </div>
   
</div>
@endsection