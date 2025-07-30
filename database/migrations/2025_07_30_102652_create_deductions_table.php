<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('amount', 10, 2);
            $table->boolean('is_percentage')->default(false);
            $table->boolean('is_statutory')->default(false); // Add this to identify statutory deductions
            $table->timestamps();
        });

        // Insert default Kenyan statutory deductions
        DB::table('deductions')->insert([
            [
                'name' => 'PAYE',
                'amount' => 30,
                'is_percentage' => true,
                'is_statutory' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'NHIF', // Note: SHIF is replacing NHIF but not fully implemented yet
                'amount' => 500, // Standard NHIF rate (will vary by salary)
                'is_percentage' => false,
                'is_statutory' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Housing Levy',
                'amount' => 1.5, // 1.5% of gross salary
                'is_percentage' => true,
                'is_statutory' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'NSSF',
                'amount' => 200, // Tier 1 contribution
                'is_percentage' => false,
                'is_statutory' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('deductions');
    }
};