<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PayrollController;

// Authentication Routes
Auth::routes();
Route::redirect('/', '/login');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Home Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Change the payroll route to payslip
Route::get('employees/{employee}/payslip', [EmployeeController::class, 'generatePayslip'])
->name('employees.payslip');
// Add to your existing routes
Route::get('employees/generate-all-payslips', [EmployeeController::class, 'generateAllPayslips'])
    ->name('employees.generate-all-payslips');

// Add new payroll management route
Route::get('/payroll', [PayrollController::class, 'index'])
->name('payroll.index');
Route::post('/payroll/update', [PayrollController::class, 'updateDeductions'])
->name('payroll.update');
    
    // Employee Routes
    Route::resource('employees', EmployeeController::class)->names([
        'index' => 'employees.index',
        'create' => 'employees.create',
        'store' => 'employees.store',
        'show' => 'employees.show',
        'edit' => 'employees.edit',
        'update' => 'employees.update',
        'destroy' => 'employees.destroy'
    ]);
    
    // Deduction Routes
    Route::resource('deductions', DeductionController::class)->except(['show']);
    

});