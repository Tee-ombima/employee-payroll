@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Form Header -->
            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-semibold text-white">Edit Employee: {{ $employee->name }}</h1>
                    <a href="{{ route('employees.index') }}" class="flex items-center text-sm text-blue-100 hover:text-white">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Employees
                    </a>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('employees.update', $employee) }}" method="POST" class="px-6 py-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Employee ID -->
                        <div>
                            <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee ID <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" id="employee_id" name="employee_id" value="{{ $employee->employee_id }}" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border"
                                    placeholder="EMP-XXXXXX">
                            </div>
                        </div>

                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" id="name" name="name" value="{{ $employee->name }}" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border"
                                    placeholder="John Doe">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{ $employee->email }}" required
                                    class="block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border"
                                    placeholder="john.doe@company.com">
                            </div>
                        </div>

                        <!-- Phone Field -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center">
                                    <label for="country" class="sr-only">Country</label>
                                    <span class="text-gray-500 sm:text-sm pl-3">+254</span>
                                </div>
                                <input type="tel" id="phone" name="phone" value="{{ $employee->phone }}"
                                    class="block w-full pl-16 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border"
                                    placeholder="700 123456">
                            </div>
                        </div>

                       <!-- Position Field -->
<div>
    <label for="position" class="block text-sm font-medium text-gray-700">
        Position <span class="text-red-500">*</span>
    </label>
    <div class="mt-1">
        <input type="text" id="position" name="position" value="{{ $employee->position }}" required
    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border"
    placeholder="Enter position">

    </div>
</div>


                        <div>
    <label for="department" class="block text-sm font-medium text-gray-700">Department <span class="text-red-500">*</span></label>
    <div class="mt-1">
        <select id="department" name="department" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border"
            onchange="toggleCustomDepartment(this.value)">
            <option value="Finance" {{ $employee->department == 'Finance' ? 'selected' : '' }}>Finance</option>
            <option value="HR" {{ $employee->department == 'HR' ? 'selected' : '' }}>Human Resources</option>
            <option value="IT" {{ $employee->department == 'IT' ? 'selected' : '' }}>Information Technology</option>
            <option value="Operations" {{ $employee->department == 'Operations' ? 'selected' : '' }}>Operations</option>
            <option value="Marketing" {{ $employee->department == 'Marketing' ? 'selected' : '' }}>Marketing</option>
            <option value="Other" {{ !in_array($employee->department, ['Finance', 'HR', 'IT', 'Operations', 'Marketing']) ? 'selected' : '' }}>Other</option>
        </select>
    </div>
    <div id="customDepartmentContainer" class="mt-2" style="{{ in_array($employee->department, ['Finance', 'HR', 'IT', 'Operations', 'Marketing']) ? 'display: none;' : '' }}">
        <label for="custom_department" class="block text-sm font-medium text-gray-700">Specify Department</label>
        <input type="text" id="custom_department" name="custom_department" 
            value="{{ !in_array($employee->department, ['Finance', 'HR', 'IT', 'Operations', 'Marketing']) ? $employee->department : '' }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border">
    </div>
</div>

                        <!-- Salary Field -->
                        <div>
                            <label for="gross_salary" class="block text-sm font-medium text-gray-700">Gross Salary (KES) <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">KES</span>
                                </div>
                                <input type="number" step="0.01" id="gross_salary" name="gross_salary" value="{{ $employee->gross_salary }}" required
                                    class="block w-full pl-16 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border"
                                    placeholder="50,000.00">
                            </div>
                        </div>

                        <!-- Hire Date Field -->
                        <div>
                            <label for="hire_date" class="block text-sm font-medium text-gray-700">Hire Date</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" id="hire_date" name="hire_date" value="{{ $employee->hire_date }}"
                                    class="block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border">
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="mt-8 pt-5 border-t border-gray-200">
                    <div class="flex justify-end">
                        <button type="button" onclick="window.location='{{ route('employees.index') }}'" 
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit" 
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Update Employee
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function toggleCustomDepartment(value) {
        const container = document.getElementById('customDepartmentContainer');
        if (value === 'Other') {
            container.style.display = 'block';
            document.getElementById('custom_department').required = true;
        } else {
            container.style.display = 'none';
            document.getElementById('custom_department').required = false;
        }
    }

    // For edit form - initialize based on current value
    document.addEventListener('DOMContentLoaded', function() {
        const currentDept = document.getElementById('department').value;
        toggleCustomDepartment(currentDept);
    });
</script>
@endsection