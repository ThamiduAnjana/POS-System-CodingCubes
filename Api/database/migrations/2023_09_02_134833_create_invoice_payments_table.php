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
        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('invoice_id')->nullable();

            $table->decimal('cash_paid')->nullable();

            $table->decimal('card_paid')->nullable();
            $table->integer('card_type')->nullable()->comment('1: visa, 2: master, 3: amex, 4: others');
            $table->integer('card_no')->nullable()->comment('last 4 digits');

            $table->decimal('cheque_paid')->nullable();
            $table->integer('cheque_no')->nullable();
            $table->dateTime('cheque_date')->nullable();
            $table->integer('cheque_payment_type')->nullable()->comment('1: cash, 2: account');
            $table->integer('cheque_bank')->nullable();

            $table->decimal('online_paid')->nullable();
            $table->integer('online_payment_type')->nullable()->comment('1: ezcash, 2: wallet, 3: bank, 4: others');
            $table->integer('online_mobile_no')->nullable();
            $table->integer('online_bank')->nullable();

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
        Schema::dropIfExists('invoice_payments');
    }
};
