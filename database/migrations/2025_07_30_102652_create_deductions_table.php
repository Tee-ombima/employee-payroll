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

    }

    public function down(): void
    {
        Schema::dropIfExists('deductions');
    }
};