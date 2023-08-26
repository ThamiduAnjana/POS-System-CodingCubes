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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->string('name_eng')->nullable();
            $table->string('name_uni')->nullable();
            $table->string('short_name')->nullable();
            $table->string('description')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('re_order_level')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('weight_id')->nullable();
            $table->integer('rack_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->tinyInteger('is_quick')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('updated_by')->nullable();
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `PRODUCT_REF_BEFORE_INSERT` BEFORE INSERT ON `products` FOR EACH ROW
            BEGIN
                SET NEW.ref = UUID();
            END'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `PRODUCT_REF_BEFORE_INSERT`');
    }
};
