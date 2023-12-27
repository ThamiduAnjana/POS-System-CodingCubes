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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_ref')->unique()->default(DB::raw('(UUID())'));

            $table->integer('payment_type')->nullable();
            $table->decimal('amount')->nullable();
            $table->integer('bank_id')->nullable();
            $table->integer('bank_transfer_reference_no')->nullable();

            $table->integer('card_type_id')->nullable()->comment('1: visa, 2: master, 3: amex, 4: others');
            $table->integer('card_no')->nullable()->comment('last 4 digits');
            $table->string('card_holder_name')->nullable();
            $table->integer('card_transaction_no')->nullable();
            $table->integer('card_expiry_month')->nullable();
            $table->integer('card_expiry_year')->nullable();
            $table->integer('card_cvv')->nullable();
            $table->decimal('card_payment_fee')->nullable();

            $table->integer('cheque_no')->nullable();
            $table->dateTime('cheque_date')->nullable();
            $table->integer('cheque_payment_type')->nullable()->comment('1: cash, 2: account');

            $table->integer('online_payment_type_id')->nullable()->comment('1: ezcash, 2: wallet, 3: bank, 4: others');

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
        Schema::dropIfExists('payments');
    }
};
