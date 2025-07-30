@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-2 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Payroll Deductions Management</h1>
        <a href="{{ route('employees.index') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
            Back to Employees
        </a>
    </div>

    <form action="{{ route('payroll.update') }}" method="POST">
        @csrf
        
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Statutory Deductions</h2>
            <div class="space-y-4">
                @foreach($statutoryDeductions as $deduction)
                <div class="flex items-center space-x-4">
                    <label class="w-1/3 font-medium text-gray-700">
                        {{ $deduction->name }}
                        @if($deduction->is_percentage)
                            (%)
                        @else
                            (KES)
                        @endif
                    </label>
                    <input type="number" 
                           name="deductions[{{ $deduction->id }}][amount]" 
                           value="{{ $deduction->amount }}"
                           step="{{ $deduction->is_percentage ? '0.01' : '1' }}"
                           class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <input type="hidden" 
                           name="deductions[{{ $deduction->id }}][id]" 
                           value="{{ $deduction->id }}">
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Custom Deductions</h2>
            <div class="space-y-4">
                @foreach($customDeductions as $deduction)
                <div class="flex items-center space-x-4">
                    <label class="w-1/3 font-medium text-gray-700">
                        {{ $deduction->name }}
                        @if($deduction->is_percentage)
                            (%)
                        @else
                            (KES)
                        @endif
                    </label>
                    <input type="number" 
                           name="deductions[{{ $deduction->id }}][amount]" 
                           value="{{ $deduction->amount }}"
                           step="{{ $deduction->is_percentage ? '0.01' : '1' }}"
                           class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <input type="hidden" 
                           name="deductions[{{ $deduction->id }}][id]" 
                           value="{{ $deduction->id }}">
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                Update Deductions
            </button>
        </div>
    </form>
</div>
@endsection