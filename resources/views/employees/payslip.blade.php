<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>

<div class="header">
    <h2>PAYSLIP</h2>
    <p>{{ $payPeriod }}</p>
</div>

<div class="summary-table">
    <table>
        <tr>
            <td><strong>Employee ID:</strong></td>
            <td>{{ $employee->employee_id }}</td>
            <td><strong>Employee Name:</strong></td>
            <td>{{ $employee->name }}</td>
        </tr>
        <tr>
            <td><strong>Department:</strong></td>
            <td>{{ $employee->department }}</td>
            <td><strong>Position:</strong></td>
            <td>{{ $employee->position }}</td>
        </tr>
        <tr>
            <td><strong>Company:</strong></td>
            <td colspan="3">{{ config('app.name') }}</td>
        </tr>
        <tr>
            <td><strong>Pay Date:</strong></td>
            <td colspan="3">{{ $payDate }}</td>
        </tr>
    </table>
</div>

<div class="section-title">Earnings & Deductions</div>
<table>
    <thead>
        <tr>
            <th>Description</th>
            <th class="right">Amount (KES)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Basic Salary</td>
            <td class="right">{{ number_format($payrollRecord->gross_salary, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Deductions:</strong></td>
            <td></td>
        </tr>
        <tr>
            <td>PAYE</td>
            <td class="right">-{{ number_format($payrollRecord->paye, 2) }}</td>
        </tr>
        <tr>
            <td>SHIF</td>
            <td class="right">-{{ number_format($payrollRecord->shif, 2) }}</td>
        </tr>
        <tr>
            <td>NSSF</td>
            <td class="right">-{{ number_format($payrollRecord->nssf, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Total Deductions</strong></td>
            <td class="right">-{{ number_format($payrollRecord->total_deductions, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Net Salary</strong></td>
            <td class="right">{{ number_format($payrollRecord->net_salary, 2) }}</td>
        </tr>
    </tbody>
</table>

<div class="grid">
    <div style="margin-top: 60px; text-align: center;">
        <span class="border-top">Employer Signature</span>
    </div>
    <div style="margin-top: 60px; text-align: center;">
        <span class="border-top">Authorized Signature</span>
    </div>
</div>

<p class="center" style="margin-top: 40px;">This is a computer-generated payslip and does not require a signature.</p>

</body>
</html>
