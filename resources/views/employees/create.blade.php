@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-4 sm:py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Form Header -->
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                    <h1 class="text-lg sm:text-xl font-semibold text-white">Add New Employee</h1>
                    <a href="{{ route('employees.index') }}" class="flex items-center text-xs sm:text-sm text-blue-100 hover:text-white">
                        <svg class="h-3 w-3 sm:h-4 sm:w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Employees
                    </a>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('employees.store') }}" method="POST" class="px-4 sm:px-6 py-4 sm:py-6">
                @csrf
                
                <div class="space-y-4 sm:space-y-6">
                    <div class="grid grid-cols-1 gap-y-4 sm:gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-xs sm:text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" id="name" name="name" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm py-2 px-3 border"
                                    placeholder="John Doe">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-xs sm:text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" required
                                    class="block w-full pl-9 sm:pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm py-2 px-3 border"
                                    placeholder="john.doe@company.com">
                            </div>
                        </div>

                        <!-- Phone Field -->
                        <div>
                            <label for="phone" class="block text-xs sm:text-sm font-medium text-gray-700">Phone Number</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center">
                                    <label for="country" class="sr-only">Country</label>
                                    <span class="text-gray-500 text-xs sm:text-sm pl-3">+254</span>
                                </div>
                                <input type="tel" id="phone" name="phone"
                                    class="block w-full pl-12 sm:pl-16 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm py-2 px-3 border"
                                    placeholder="700 123456">
                            </div>
                        </div>

                        <!-- Position Field -->
                        <div>
                            <label for="position" class="block text-xs sm:text-sm font-medium text-gray-700">Position <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" id="position" name="position" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm py-2 px-3 border"
                                    placeholder="Enter position">
                            </div>
                        </div>

                        <!-- Department Field -->
                        <div>
                            <label for="department" class="block text-xs sm:text-sm font-medium text-gray-700">Department <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <select id="department" name="department" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm py-2 px-3 border"
                                    onchange="toggleCustomDepartment(this.value)">
                                    <option value="" disabled selected>Select department</option>
                                    <option value="Finance">Finance</option>
                                    <option value="HR">Human Resources</option>
                                    <option value="IT">Information Technology</option>
                                    <option value="Operations">Operations</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div id="customDepartmentContainer" class="mt-2" style="display: none;">
                                <label for="custom_department" class="block text-xs sm:text-sm font-medium text-gray-700">Specify Department</label>
                                <input type="text" id="custom_department" name="custom_department"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm py-2 px-3 border">
                            </div>
                        </div>

                        <!-- Salary Field -->
                        <div>
                            <label for="gross_salary" class="block text-xs sm:text-sm font-medium text-gray-700">Gross Salary (KES) <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-xs sm:text-sm">KES</span>
                                </div>
                                <input type="number" step="0.01" id="gross_salary" name="gross_salary" required
                                    class="block w-full pl-12 sm:pl-16 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm py-2 px-3 border"
                                    placeholder="50,000.00">
                            </div>
                        </div>

                        <!-- Hire Date Field -->
                        <div>
                            <label for="hire_date" class="block text-xs sm:text-sm font-medium text-gray-700">Hire Date</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" id="hire_date" name="hire_date"
                                    class="block w-full pl-9 sm:pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm py-2 px-3 border">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="mt-6 sm:mt-8 pt-4 sm:pt-5 border-t border-gray-200">
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 sm:gap-0">
                        <button type="button" onclick="window.location='{{ route('employees.index') }}'" 
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit" 
                            class="sm:ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-xs sm:text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-0.5 mr-1.5 h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Save Employee
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const departmentSelect = document.getElementById('department');
    const customDepartmentContainer = document.getElementById('customDepartmentContainer');
    const customDepartmentInput = document.getElementById('custom_department');

    function toggleCustomDepartment(value) {
        if (value === 'Other') {
            customDepartmentContainer.style.display = 'block';
            customDepartmentInput.required = true;
        } else {
            customDepartmentContainer.style.display = 'none';
            customDepartmentInput.required = false;
            customDepartmentInput.value = ''; // Clear old value
        }
    }

    // Initialize on page load
    toggleCustomDepartment(departmentSelect.value);

    // Listen to changes
    departmentSelect.addEventListener('change', function () {
        toggleCustomDepartment(this.value);
    });

    // Set hire_date default only if it has no value
    const hireDateInput = document.getElementById('hire_date');
    if (!hireDateInput.value) {
        const today = new Date().toISOString().split('T')[0];
        hireDateInput.value = today;
    }
});
</script>
@endsection