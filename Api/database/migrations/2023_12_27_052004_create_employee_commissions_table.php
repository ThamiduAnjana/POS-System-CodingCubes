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
        Schema::create('employee_commissions', function (Blueprint $table) {
            $table->id();
            $table->string('employee_commission_ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('employee_id');
            $table->tinyInteger('is_percentage')->comment('0 = no (value act as amount), 1 = yes (value act as percentage)');
            $table->decimal('value');
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
        Schema::dropIfExists('employee_commissions');
    }
};
