<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Models\PayrollRecord;
use Barryvdh\DomPDF\Facade\Pdf;

// Redirect root to login
Route::redirect('/', '/login');

// Authentication Routes
Auth::routes();

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // 📊 Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 👥 Employee Resource Routes
    Route::resource('employees', EmployeeController::class)->names([
        'index'   => 'employees.index',
        'create'  => 'employees.create',
        'store'   => 'employees.store',
        'show'    => 'employees.show',
        'edit'    => 'employees.edit',
        'update'  => 'employees.update',
        'destroy' => 'employees.destroy',
    ]);

    // 📄 Individual Payslip Generation
    Route::get('employees/{employee}/payslip', [EmployeeController::class, 'generatePayslip'])
        ->name('employees.payslip');

    // 🔍 Validate payslip period before generation
    Route::get('/employees/{employee}/validate-payslip', [EmployeeController::class, 'validatePayslipPeriod']);

    // 📁 Check if a payslip exists (AJAX support)
    Route::get('/employees/{employee}/check-payslip', [EmployeeController::class, 'checkPayslipExists']);

    // 📚 Payroll History for an Employee
    Route::get('/employees/{employee}/payroll-history', [EmployeeController::class, 'payrollHistory'])
        ->name('employees.payroll-history');

        Route::get('/payroll-records/{payrollRecord}/download', [EmployeeController::class, 'downloadPayslip'])
        ->name('payslip.download');
    

    // 🧾 Bulk Payslip Generation
    Route::post('employees/generate-all-payslips', [EmployeeController::class, 'generateAllPayslips'])
    ->name('employees.generate-all-payslips');

    // 💰 Payroll Management
    Route::get('/payroll', [PayrollController::class, 'index'])
        ->name('payroll_deductions.index');
        
    Route::post('/payroll/update', [PayrollController::class, 'updateDeductions'])
        ->name('payroll_deductions.update');

    // 📈 Analytics
    Route::get('/payroll/analytics', [EmployeeController::class, 'payrollAnalytics'])
        ->name('payroll_deductions.analytics');
});
