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
        Schema::create('product_costs', function (Blueprint $table) {
            $table->id();
            $table->string('product_cost_ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('product_list_id');
            $table->string('barcode')->nullable();
            $table->string('cost_code')->nullable();
            $table->decimal('cost_exc_tax')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('cost_inc_tax')->nullable();
            $table->decimal('margin')->nullable();
            $table->decimal('price')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('active = 1, inactive = 0');
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
        Schema::dropIfExists('product_costs');
    }
};
