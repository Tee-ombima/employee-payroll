@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4 sm:py-8">
    <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-gray-800">Payroll Analytics Dashboard</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 mb-8 sm:mb-12">
    
        <!-- Monthly Totals Table -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Monthly Payroll Totals</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gross</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PAYE</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NSSF</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SHIF</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Other</th>
                            <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($monthlyTotals as $month)
                        <tr>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-xs sm:text-sm">{{ \Carbon\Carbon::create($month->year, $month->month)->format('M Y') }}</td>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-xs sm:text-sm">KES {{ number_format($month->total_gross, 2) }}</td>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-xs sm:text-sm text-red-600">KES {{ number_format($month->total_paye, 2) }}</td>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-xs sm:text-sm text-blue-600">KES {{ number_format($month->total_nssf, 2) }}</td>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-xs sm:text-sm text-purple-600">KES {{ number_format($month->total_shif, 2) }}</td>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-xs sm:text-sm text-orange-600">KES {{ number_format($month->total_other_deductions, 2) }}</td>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-xs sm:text-sm text-green-600 font-medium">KES {{ number_format($month->total_net, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @if($monthlyTotals->isNotEmpty())
                    <tfoot class="bg-gray-50">
                        <tr>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Totals</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-gray-700">KES {{ number_format($monthlyTotals->sum('total_gross'), 2) }}</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-red-700">KES {{ number_format($monthlyTotals->sum('total_paye'), 2) }}</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-blue-700">KES {{ number_format($monthlyTotals->sum('total_nssf'), 2) }}</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-purple-700">KES {{ number_format($monthlyTotals->sum('total_shif'), 2) }}</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-orange-700">KES {{ number_format($monthlyTotals->sum('total_other_deductions'), 2) }}</th>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-medium text-green-700">KES {{ number_format($monthlyTotals->sum('total_net'), 2) }}</th>
                        </tr>
                    </tfoot>
                    @endif
                </table>

                <!-- Pagination -->
                <div class="mt-4 px-3 sm:px-4 py-3">
                    {{ $monthlyTotals->links() }}
                </div>
            </div>
        </div>

        <!-- Summary Panel -->
        <div class="space-y-4 sm:space-y-6">

            <!-- Snapshot -->
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Current Month Snapshot</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <div class="bg-blue-50 p-3 sm:p-4 rounded-lg">
                        <p class="text-xs sm:text-sm text-blue-600">Employees Paid (This Month)</p>
                        <p class="text-xl sm:text-2xl font-bold">{{ $currentMonthData->employee_count }}</p>
                    </div>
                    <div class="bg-green-50 p-3 sm:p-4 rounded-lg">
                        <p class="text-xs sm:text-sm text-green-600">Total PAYE</p>
                        <p class="text-xl sm:text-2xl font-bold">KES {{ number_format($currentMonthData->total_paye, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Overall Stats -->
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Overall Payroll Summary</h2>
                <ul class="space-y-1 sm:space-y-2 text-gray-700 text-xs sm:text-sm">
                    <li><strong>Total Employees:</strong> {{ $totalEmployees }}</li>
                    <li><strong>Total Gross Paid:</strong> KES {{ number_format($monthlyTotals->sum('total_gross'), 2) }}</li>
                    <li><strong>Total Deductions:</strong> KES {{ number_format($monthlyTotals->sum('total_paye') + $monthlyTotals->sum('total_nssf') + $monthlyTotals->sum('total_shif') + $monthlyTotals->sum('total_other_deductions'), 2) }}</li>
                    <li><strong>Average Net Pay:</strong> KES {{ number_format($monthlyTotals->avg('total_net'), 2) }}</li>
                </ul>
            </div>

            <!-- Back Button -->
            <div>
                <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded shadow">
                    ← Back
                </a>
            </div>

        </div>
    </div>
</div>
@endsection