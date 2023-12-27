<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basic_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('basic_salary_ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('employee_id');
            $table->tinyInteger('salary_type')->comment('1 = monthly, 2 = daily, 3 = hourly');
            $table->decimal('amount');
            $table->dateTime('start_at')->useCurrent();
            $table->dateTime('end_at');
            $table->tinyInteger('is_active')->default(1)->comment('active = 1, inactive = 0');
            $table->integer('location_id')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_salaries');
    }
};
