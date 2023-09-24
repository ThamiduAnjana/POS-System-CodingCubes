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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique()->default(DB::raw('(UUID())'));
            $table->string('title')->nullable();
            $table->string('initials')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->tinyInteger('sex')->nullable();
            $table->string('nic')->nullable();
            $table->string('passport')->nullable();
            $table->string('driving_license')->nullable();
            $table->date('dob')->nullable();
            $table->float('discount_rate')->nullable()->comment('discount limit');
            $table->float('commission_rate')->nullable();
            $table->float('basic_salary')->nullable();
            $table->integer('allowance_id')->nullable();
            $table->float('ot_rate')->nullable();
            $table->float('insurance')->nullable();
            $table->float('epf_rate')->nullable();
            $table->float('etf_rate')->nullable();
            $table->float('stamp_duty')->nullable();
            $table->integer('salary_type_id')->default(1)->comment('month = 1, day = 2');
            $table->tinyInteger('department_id')->nullable()->comment('management = 1, hr = 2, accounting = 3, production & stork management = 4, sales & marketing = 5' );
            $table->tinyInteger('is_rep')->default(0);
            $table->integer('credential_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('active = 1, inactive = 0');
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
        Schema::dropIfExists('employees');
    }
};
