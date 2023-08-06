<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('return_invoices', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('ref')->uuid();
            $table->dateTime('date_time')->useCurrent();
            $table->integer('customer_id')->nullable();
            $table->integer('gin_id')->nullable();
            $table->integer('return_invoice_product_id')->nullable();
            $table->decimal('balance')->nullable();
            $table->integer('device_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_invoices');
    }
};
