<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payroll_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')
            ->constrained('employees')
            ->onDelete('cascade');            $table->date('pay_period');
            $table->decimal('gross_salary', 12, 2)->default(0);
            $table->decimal('paye', 10, 2);
            $table->decimal('shif', 8, 2);
            $table->decimal('nssf', 8, 2);
            (0);
           
            $table->decimal('total_deductions', 12, 2);
            $table->decimal('net_salary', 12, 2);


            $table->timestamps();

            $table->unique(['employee_id', 'pay_period']); // Prevent duplicate payments

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_records');
    }
};
