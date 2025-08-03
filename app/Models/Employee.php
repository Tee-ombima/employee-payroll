<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Employee extends Model
{
    protected $fillable = [
        'employee_id', 
        'name', 
        'email', 
        'phone',
        'position',
        'department',
        'custom_department',
        'gross_salary',
        'hire_date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->employee_id = 'EMP-' . strtoupper(uniqid());
        });
    }

    public function payrollRecords(): HasMany
    {
        return $this->hasMany(PayrollRecord::class);
    }

    public function getDepartmentAttribute($value): string
    {
        return $value === 'Other' ? $this->custom_department : $value;
    }

    // In app/Models/Employee.php

public function hasPaidForMonth($yearMonth)
{
    return $this->payrollRecords()
        ->whereYear('pay_period', Carbon::parse($yearMonth)->year)
        ->whereMonth('pay_period', Carbon::parse($yearMonth)->month)
        ->exists();
}
public function wasEmployedDuring($date)
{
    $date = Carbon::parse($date);
    
    // If hired after the period
    if ($this->hire_date && $date->lt($this->hire_date)) {
        return false;
    }
    
    // If terminated before the period
    if ($this->termination_date && $date->gt($this->termination_date)) {
        return false;
    }
    
    return true;
}
}