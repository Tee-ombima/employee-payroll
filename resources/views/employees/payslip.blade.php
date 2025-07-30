<!DOCTYPE html>
<html>
<head>
    <title>Payslip - {{ $employee->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .company { font-size: 18px; font-weight: bold; }
        .payslip-title { font-size: 16px; margin: 10px 0; }
        .details { display: flex; justify-content: space-between; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total-row { font-weight: bold; }
        .signature { margin-top: 40px; display: flex; justify-content: space-between; }
        .footer { margin-top: 30px; font-size: 12px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company">YOUR COMPANY NAME</div>
        <div class="payslip-title">PAYSLIP FOR {{ $payPeriod }}</div>
    </div>
    
    <div class="details">
        <div>
            <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
            <p><strong>Name:</strong> {{ $employee->name }}</p>
            <p><strong>Department:</strong> {{ $employee->department }}</p>
        </div>
        <div>
            <p><strong>Pay Date:</strong> {{ $payDate }}</p>
            <p><strong>Position:</strong> {{ $employee->position }}</p>
            <p><strong>Pay Period:</strong> {{ $payPeriod }}</p>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount (KES)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deductionDetails as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ number_format($item['amount'], 2) }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td>Total Deductions</td>
                <td>{{ number_format($totalDeductions, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td>Net Salary</td>
                <td>{{ number_format($netSalary, 2) }}</td>
            </tr>
        </tbody>
    </table>
    
    <div class="signature">
        <div>
            <p>_________________________</p>
            <p>Employee Signature</p>
        </div>
        <div>
            <p>_________________________</p>
            <p>Authorized Signature</p>
        </div>
    </div>
    
    <div class="footer">
        <p>This is a computer generated payslip and does not require a signature</p>
    </div>
</body>
</html>