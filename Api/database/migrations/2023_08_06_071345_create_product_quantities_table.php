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
        Schema::create('product_quantities', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->integer('product_id')->nullable();
            $table->decimal('cost')->nullable();
            $table->string('cost_code')->nullable();
            $table->decimal('cost_percentage')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('cash_percentage')->nullable();
            $table->decimal('cash_price')->nullable();
            $table->decimal('credit_percentage')->nullable();
            $table->decimal('credit_price')->nullable();
            $table->decimal('qty')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('updated_by')->nullable();
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `PRODUCT_QUANTITY_REF_BEFORE_INSERT` BEFORE INSERT ON `product_quantities` FOR EACH ROW
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
        Schema::dropIfExists('product_quantities');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `PRODUCT_QUANTITY_REF_BEFORE_INSERT`');
    }
};
