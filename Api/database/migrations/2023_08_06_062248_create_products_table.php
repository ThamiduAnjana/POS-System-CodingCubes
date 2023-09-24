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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique()->default(DB::raw('(UUID())'));
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('sku')->nullable();
            $table->string('description')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('re_order_level')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('rack_id')->nullable();
            $table->tinyInteger('is_quick')->default(0);
            $table->decimal('cost')->nullable();
            $table->decimal('margin')->nullable();
            $table->tinyInteger('product_type')->default(0)->comment('0 = single, 1 = combo, 2 = variation');
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
        Schema::dropIfExists('products');
    }
};
