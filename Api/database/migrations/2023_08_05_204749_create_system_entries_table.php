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
        Schema::create('system_entries', function (Blueprint $table) {
            $table->id();
            $table->string('system_entry_ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('employee_id')->nullable();
            $table->integer('device_id')->nullable();
            $table->tinyInteger('is_in')->default(1);
            $table->dateTime('at')->useCurrent();
            $table->tinyInteger('is_active')->default(1)->comment('active = 1, inactive = 0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_entries');
    }
};
