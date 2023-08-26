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
        Schema::create('goods_issue_note_products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->integer('product_id')->nullable();
            $table->integer('product_qty_id')->nullable();
            $table->float('qty')->nullable();
            $table->float('price')->nullable();
            $table->float('discount')->nullable();
            $table->float('tax')->nullable();
            $table->float('total')->nullable();
            $table->integer('employee_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('updated_by')->nullable();
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `GIN_PRODUCT_REF_BEFORE_INSERT` BEFORE INSERT ON `goods_issue_note_products` FOR EACH ROW
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
        Schema::dropIfExists('goods_issue_note_products');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `GIN_PRODUCT_REF_BEFORE_INSERT`');
    }
};
