<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollRecord extends Model
{
    protected $fillable = [
        'employee_id',
        'pay_period',
        'gross_salary',
        'paye',
        'shif',
        'nssf',
        'total_deductions',
        'net_salary',
    ];

    protected $casts = [
        'pay_period' => 'date:Y-m-d',
        'gross_salary' => 'decimal:2',
        'paye' => 'decimal:2',
        'shif' => 'decimal:2',
        'nssf' => 'decimal:2',
        'total_deductions' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeForPeriod($query, string $year, string $month = null)
    {
        $query->whereYear('pay_period', $year);
        
        if ($month) {
            $query->whereMonth('pay_period', $month);
        }
        
        return $query;
    }
}