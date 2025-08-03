@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Employee Header -->
            <div class="px-6 py-5 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-16 w-16 rounded-full bg-blue-500 flex items-center justify-center text-2xl font-bold text-white">
                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                            </div>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">{{ $employee->name }}</h1>
                            <p class="text-blue-100">{{ $employee->position }}</p>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0 flex flex-wrap gap-2">
                        <a href="{{ route('employees.edit', $employee) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <button type="button" onclick="openPayslipModal()" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Generate Payslip
                        </button>
                        <a href="{{ route('employees.payroll-history', $employee) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            History
                        </a>
                    </div>
                </div>
            </div>

            <!-- Employee Details -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Personal Information -->
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Personal Information</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Employee ID</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $employee->employee_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email Address</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $employee->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone Number</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $employee->phone ?: 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Details -->
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Employment Details</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Department</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $employee->department === 'Other' ? $employee->custom_department : $employee->department }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Position</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $employee->position }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Hire Date</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($employee->hire_date)->format('F j, Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <p class="mt-1 text-sm text-gray-900 capitalize">{{ $employee->status }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Employment Duration</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($employee->hire_date)->diffForHumans(null, true) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Gross Salary</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    KES {{ number_format($employee->gross_salary, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0">
                <a href="{{ route('employees.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Employees
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Payslip Modal (EXACTLY AS YOU HAD IT) -->
<div id="payslipModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        </div>

        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-md w-full z-50">
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">Generate Payslip</h3>
                <div id="validationMessage" class="hidden mb-4 px-4 py-2 rounded text-sm"></div>

                <form id="payslipForm" method="GET" action="{{ route('employees.payslip', $employee->id) }}" onsubmit="handlePayslipSubmit(event)">
                    <div class="mt-4">
                        <div class="mb-4">
                            <label for="pay_period" class="block text-sm font-medium text-gray-700">Pay Period</label>
                            <input type="month" name="pay_period" id="pay_period" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm"
                                   value="{{ now()->format('Y-m') }}"
                                   max="{{ now()->format('Y-m') }}">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button"
                                onclick="closePayslipModal()"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                            Generate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Modal functions (EXACTLY AS YOU HAD THEM)
function openPayslipModal() {
  document.body.style.overflow = 'hidden';
  document.getElementById('payslipModal').classList.remove('hidden');
}

function closePayslipModal() {
  document.body.style.overflow = 'auto';
  document.getElementById('payslipModal').classList.add('hidden');
}

async function handlePayslipSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const payPeriod = form.pay_period.value;
    const employeeId = {{ $employee->id }};
    
    try {
        const validationResponse = await fetch(`/employees/${employeeId}/validate-payslip?pay_period=${payPeriod}`);
        const validationData = await validationResponse.json();
        
        if (!validationData.valid) {
            showValidationMessage(validationData.message, false); // false = error
            return;
        }

        showValidationMessage('Validation successful. Generating payslip...', true);
        setTimeout(() => form.submit(), 1000); // Delay for user feedback
    } catch (error) {
        console.error('Validation error:', error);
        showValidationMessage('Error validating payslip period.', false);
    }
}

function showValidationMessage(message, isSuccess = false) {
    const box = document.getElementById('validationMessage');
    box.textContent = message;
    box.className = `mb-4 px-4 py-2 rounded text-sm ${
        isSuccess ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
    }`;
    box.classList.remove('hidden');

    // Hide after 5 seconds (5000 ms)
    setTimeout(() => {
        box.classList.add('hidden');
        box.textContent = '';
    }, 5000);
}



// Close modal when pressing Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closePayslipModal();
  }
});
</script>
@endsection