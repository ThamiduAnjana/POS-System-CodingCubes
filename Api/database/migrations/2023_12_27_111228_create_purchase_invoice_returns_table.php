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
        Schema::create('purchase_invoice_returns', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_invoice_return_ref')->unique()->default(DB::raw('(UUID())'));
            $table->string('purchase_invoice_return_no')->nullable();
            $table->dateTime('purchase_invoice_return_date')->nullable();
            $table->integer('purchase_invoice_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('payment_status_id')->nullable();
            $table->decimal('total')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('purchase_invoice_returns');
    }
};
