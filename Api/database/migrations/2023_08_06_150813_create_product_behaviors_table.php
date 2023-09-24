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
        Schema::create('product_behaviors', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('product_id')->nullable();
            $table->decimal('qty')->nullable();
            $table->decimal('qty_balance')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1: sale, 2: sale-return, 3: purchase, 4: purchase-return');
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
        Schema::dropIfExists('product_behaviors');
    }
};
