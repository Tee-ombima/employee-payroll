@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        

        <div class="bg-white shadow-xl rounded-xl overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-5 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold">Payroll Deductions Management</h1>
                        <p class="mt-1 text-blue-100">Configure statutory and custom payroll deductions</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('employees.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            ← Back to Employees
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-8">
                <form action="{{ route('payroll_deductions.update') }}" method="POST">
                    @csrf
                    
                    <!-- Statutory Deductions Card -->
                    <div class="mb-10">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-medium text-gray-900">Statutory Deductions</h2>
                            <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">Required by Law</span>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <div class="space-y-6">
                                @foreach($statutoryDeductions as $deduction)
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                                    <label class="md:col-span-4 font-medium text-gray-700 flex items-center">
                                        {{ $deduction->name }}
                                        <span class="ml-2 text-xs text-gray-500 font-normal">
                                            {{ $deduction->is_percentage ? '(Percentage)' : '(Fixed Amount)' }}
                                        </span>
                                    </label>
                                    <div class="md:col-span-6 flex items-center">
                                        <span class="mr-2 text-gray-500">
                                            {{ $deduction->is_percentage ? '%' : 'KES' }}
                                        </span>
                                        <input type="number" 
                                               name="deductions[{{ $deduction->id }}][amount]" 
                                               value="{{ $deduction->amount }}"
                                               step="{{ $deduction->is_percentage ? '0.01' : '1' }}"
                                               class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                    <input type="hidden" 
                                           name="deductions[{{ $deduction->id }}][id]" 
                                           value="{{ $deduction->id }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                   

                    <!-- Form Footer -->
                    <div class="pt-5 border-t border-gray-200 flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save All Deductions
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection