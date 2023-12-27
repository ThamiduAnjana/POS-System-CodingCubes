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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address_ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('owner_type')->default(1)->comment('1 = employee, 2 = customer, 3 = supplier, 4 = supplier representative');
            $table->integer('owner_id')->nullable();
            $table->string('house')->nullable();
            $table->string('street')->nullable();
            $table->string('village')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->tinyInteger('is_primary')->default(0);
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
        Schema::dropIfExists('addresses');
    }
};
