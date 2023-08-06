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
        Schema::create('goods_issue_notes', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('ref')->uuid();
            $table->dateTime('date_time')->useCurrent();
            $table->tinyInteger('is_advance')->default(0)->comment('0: no, 1: yes');
            $table->integer('customer_id')->nullable();
            $table->integer('gin_product_id')->nullable();
            $table->decimal('sub_total')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('total')->nullable();
            $table->decimal('cash_paid')->nullable();

            $table->decimal('card_paid')->nullable();
            $table->integer('card_type')->nullable()->comment('1: visa, 2: master, 3: amex, 4: others');
            $table->integer('card_no')->nullable();

            $table->decimal('cheque_paid')->nullable();
            $table->integer('cheque_no')->nullable();
            $table->dateTime('cheque_date')->nullable();
            $table->integer('cheque_payment_type')->nullable()->comment('1: cash, 2: account');
            $table->integer('cheque_bank_id')->nullable();

            $table->decimal('credit_paid')->nullable();

            $table->decimal('online_paid')->nullable();
            $table->integer('online_payment_type')->nullable()->comment('1: ezcash, 2: wallet, 3: bank, 4: others');
            $table->integer('online_mobile_no')->nullable();
            $table->integer('online_bank_id')->nullable();

            $table->decimal('received_amount')->nullable();
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
        Schema::dropIfExists('goods_issue_notes');
    }
};
