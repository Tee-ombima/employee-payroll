<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = [
        'employee_id', 
        'name', 
        'email', 
        'phone',
        'position',
        'department',
        'gross_salary',
        'hire_date'
    ];

    protected static function boot()
{
    parent::boot();

    static::creating(function ($employee) {
        $employee->employee_id = 'EMP-' . strtoupper(uniqid());
    });
}
}
