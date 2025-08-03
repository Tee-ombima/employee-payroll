@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-4 sm:p-6">
    <!-- Header Section with Breadcrumbs and User Profile -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 sm:mb-6 space-y-3 sm:space-y-0">
        <div>
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-500 hover:text-blue-600">
                            <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-xs sm:text-sm font-medium text-gray-700 md:ml-2">Employee Management</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Employee Management</h1>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm text-red-500 hover:bg-gray-100 rounded">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </button>
        </form>
    </div>

    <!-- Primary Navigation Tabs -->
    <div class="border-b border-gray-200 mb-4 sm:mb-6 overflow-x-auto">
        <nav class="-mb-px flex space-x-4 sm:space-x-8 min-w-max">
            <a href="{{ route('employees.index') }}" 
               class="{{ request()->routeIs('employees.index') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 px-1 border-b-2 font-medium text-xs sm:text-sm">
                Employee Directory
            </a>
            <a href="{{ route('payroll_deductions.index') }}" 
               class="{{ request()->routeIs('payroll_deductions.index') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 px-1 border-b-2 font-medium text-xs sm:text-sm">
                Payroll Management
            </a>
            <a href="{{ route('payroll_deductions.analytics') }}" 
               class="{{ request()->routeIs('payroll_deductions.analytics') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 px-1 border-b-2 font-medium text-xs sm:text-sm">
                Payroll Analytics
            </a>
            <button type="button" 
                    onclick="document.getElementById('generateAllModal').classList.remove('hidden')"
                    class="whitespace-nowrap py-1.5 px-2 sm:py-2 sm:px-3 border border-gray-300 text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-100 rounded">
                Generate All Payslips
            </button>
        </nav>
    </div>

    <!-- Generate All Payslips Modal -->
    <div id="generateAllModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-md w-full z-50">
                <div class="px-4 sm:px-6 py-4">
                    <h3 class="text-base sm:text-lg font-medium text-gray-900">Generate Payslips for All Employees</h3>
                    <form action="{{ route('employees.generate-all-payslips') }}" method="POST" class="mt-4">
    @csrf
    <div class="mb-4">
        <label for="pay_period" class="block text-xs sm:text-sm font-medium text-gray-700">Pay Period</label>
        <input type="month" name="pay_period" id="pay_period" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-xs sm:text-sm"
               value="{{ now()->format('Y-m') }}"
               max="{{ now()->format('Y-m') }}">
    </div>
    <div class="flex justify-end space-x-2">
        <button type="button"
                onclick="document.getElementById('generateAllModal').classList.add('hidden')"
                class="px-3 py-1.5 sm:px-4 sm:py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-xs sm:text-sm">
            Cancel
        </button>
        <button type="submit"
                class="px-3 py-1.5 sm:px-4 sm:py-2 bg-green-600 text-white rounded hover:bg-green-700 text-xs sm:text-sm">
            Generate
        </button>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 gap-3">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('employees.create') }}" 
               class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Employee
            </a>
            
        </div>
        <div class="w-full sm:w-auto">
    <!-- Mobile Search Button (visible only on small screens) -->
    <button type="button" 
            class="sm:hidden p-2 text-gray-500 hover:text-gray-700 focus:outline-none"
            onclick="document.getElementById('mobileSearchContainer').classList.toggle('hidden'); document.getElementById('searchInput').focus()">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </button>

    <!-- Search Form (hidden on mobile by default, shown when icon clicked) -->
    <div id="mobileSearchContainer" class="hidden sm:block">
        <form method="GET" action="{{ route('employees.index') }}" class="relative">
            <div class="relative rounded-md shadow-sm">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       id="searchInput"
                       class="block w-full pr-8 pl-3 py-1.5 sm:py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm"
                       placeholder="Search employees...">
                <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                    <!-- Clickable search icon for submission -->
                    <button type="submit" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
    </div>

    <!-- Employee Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                    <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($employees as $index => $employee)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 sm:px-6 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{ $index + 1 + (($employees->currentPage() - 1) * $employees->perPage()) }}</td>
                        <td class="px-3 py-3 sm:px-6 sm:py-4 whitespace-nowrap text-xs sm:text-sm font-medium text-gray-900">{{ $employee->employee_id }}</td>
                        <td class="px-3 py-3 sm:px-6 sm:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                                </div>
                                <div class="ml-2 sm:ml-4">
                                    <div class="text-xs sm:text-sm font-medium text-gray-900">{{ $employee->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $employee->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-3 sm:px-6 sm:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $employee->department }}
                            </span>
                        </td>
                        <td class="px-3 py-3 sm:px-6 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900">KES {{ number_format($employee->gross_salary, 2) }}</td>
                        <td class="px-3 py-3 sm:px-6 sm:py-4 whitespace-nowrap text-xs sm:text-sm font-medium">
                            <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-1 sm:space-y-0">
                                <a href="{{ route('employees.show', $employee) }}" 
                                   class="text-blue-600 hover:text-blue-900 flex items-center"
                                   title="View Details">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                                <a href="{{ route('employees.edit', $employee) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 flex items-center"
                                   title="Edit">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 flex items-center confirm-delete"
                                            title="Delete">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between">
        <div class="text-xs sm:text-sm text-gray-700 mb-3 sm:mb-0">
            Showing <span class="font-medium">{{ $employees->firstItem() }}</span> to <span class="font-medium">{{ $employees->lastItem() }}</span> of <span class="font-medium">{{ $employees->total() }}</span> employees
        </div>
        <div class="flex space-x-1">
            @if ($employees->onFirstPage())
                <span class="px-2 py-1 sm:px-3 sm:py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed text-xs sm:text-sm">Previous</span>
            @else
                <a href="{{ $employees->previousPageUrl() }}" class="px-2 py-1 sm:px-3 sm:py-1 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition text-xs sm:text-sm">Previous</a>
            @endif

            @foreach ($employees->getUrlRange(1, $employees->lastPage()) as $page => $url)
                @if ($page == $employees->currentPage())
                    <span class="px-2 py-1 sm:px-3 sm:py-1 bg-blue-500 text-white rounded text-xs sm:text-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-2 py-1 sm:px-3 sm:py-1 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition text-xs sm:text-sm">{{ $page }}</a>
                @endif
            @endforeach

            @if ($employees->hasMorePages())
                <a href="{{ $employees->nextPageUrl() }}" class="px-2 py-1 sm:px-3 sm:py-1 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition text-xs sm:text-sm">Next</a>
            @else
                <span class="px-2 py-1 sm:px-3 sm:py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed text-xs sm:text-sm">Next</span>
            @endif
        </div>
    </div>
</div>

<script>
    // Profile dropdown toggle
    document.getElementById('profileDropdownBtn').addEventListener('click', function() {
        document.getElementById('profileDropdown').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profileDropdown');
        const button = document.getElementById('profileDropdownBtn');
        
        if (!button.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Confirm delete action
    document.querySelectorAll('.confirm-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this employee?')) {
                e.preventDefault();
            }
        });
    });
</script>




<style>
    /* Smooth transitions */
    .transition {
        transition: all 0.2s ease-in-out;
    }
    
    /* Hover effects */
    tr:hover {
        background-color: #f9fafb;
    }
    
    /* Avatar colors */
    .bg-blue-100 {
        background-color: #dbeafe;
    }
    .text-blue-600 {
        color: #2563eb;
    }
    
    /* Responsive table cells */
    @media (max-width: 640px) {
        td, th {
            padding: 0.5rem 0.75rem;
        }
    }
    /* Smooth transition for mobile search */
    #mobileSearchContainer {
        transition: all 0.3s ease;
    }
</style>
@endsection