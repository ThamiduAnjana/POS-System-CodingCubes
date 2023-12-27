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
            $table->string('product_ref')->unique()->default(DB::raw('(UUID())'));
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('sku')->nullable();
            $table->string('description')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('re_order_level')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('rack_id')->nullable();
            $table->integer('media_id')->nullable();
            $table->tinyInteger('is_quick')->default(0);
            $table->tinyInteger('is_sale')->default(0);
            $table->tinyInteger('is_manage_stock')->default(1)->comment('1 = inventory item, 0 = service item');
            $table->tinyInteger('product_type')->default(0)->comment('0 = single, 1 = combo, 2 = variation');
            $table->tinyInteger('enable_imei')->default(0)->comment('0 = no, 1 = yes');
            $table->tinyInteger('enable_serial')->default(0)->comment('0 = no, 1 = yes');
            $table->decimal('weight')->nullable();
            $table->tinyInteger('applicable_tax')->default(0)->comment('0 = no, 1 = yes');
            $table->tinyInteger('applicable_selling_tax')->default(0)->comment('0 = no, 1 = yes');
            $table->string('custom_field_1')->nullable();
            $table->string('custom_field_2')->nullable();
            $table->string('custom_field_3')->nullable();
            $table->string('custom_field_4')->nullable();
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
        Schema::dropIfExists('products');
    }
};
