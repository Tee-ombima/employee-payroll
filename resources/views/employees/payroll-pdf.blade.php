<!DOCTYPE html>
<html>
<head>
    <title>Payroll Slip - {{ $employee->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Payroll Slip</h1>
        <p>{{ now()->format('F Y') }}</p>
    </div>
    
    <div class="details">
        <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
        <p><strong>Name:</strong> {{ $employee->name }}</p>
        <p><strong>Department:</strong> {{ $employee->department }}</p>
        <p><strong>Position:</strong> {{ $employee->position }}</p>
    </div>
    
    <table>
        <tr>
            <th>Description</th>
            <th>Amount (KES)</th>
        </tr>
        <tr>
            <td>Gross Salary</td>
            <td>{{ number_format($grossSalary, 2) }}</td>
        </tr>
        <tr>
            <th colspan="2">Deductions</th>
        </tr>
        @foreach($deductionDetails as $deduction)
        <tr>
            <td>{{ $deduction['name'] }}</td>
            <td>{{ number_format($deduction['amount'], 2) }}</td>
        </tr>
        @endforeach
        <tr class="total">
            <td>Total Deductions</td>
            <td>{{ number_format($totalDeductions, 2) }}</td>
        </tr>
        <tr class="total">
            <td>Net Salary</td>
            <td>{{ number_format($netSalary, 2) }}</td>
        </tr>
    </table>
    
    <div class="footer">
        <p>Generated on: {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>
</body>
</html>