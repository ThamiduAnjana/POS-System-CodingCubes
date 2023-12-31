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
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_invoice_ref')->unique()->default(DB::raw('(UUID())'));
            $table->string('purchase_invoice_no')->nullable();
            $table->dateTime('purchase_invoice_date')->nullable();
            $table->dateTime('reference_date')->nullable();
            $table->string('reference_no')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('payment_status_id')->nullable();
            $table->integer('payment_term')->nullable();
            $table->tinyInteger('payment_term_type')->nullable()->comment('month = 1, day = 2');
            $table->decimal('sub_total')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('delivery_charge')->nullable();
            $table->decimal('net_total')->nullable();
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
        Schema::dropIfExists('purchase_invoices');
    }
};
