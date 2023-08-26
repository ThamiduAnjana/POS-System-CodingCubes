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
        Schema::create('product_behaviors', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->integer('product_qty_id')->nullable();
            $table->decimal('cost')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('qty')->nullable();
            $table->decimal('balance')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1: purchase, 2: sale, 3: return, 4: damage');
            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('updated_by')->nullable();
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `PRODUCT_BEHAVIOR_REF_BEFORE_INSERT` BEFORE INSERT ON `product_behaviors` FOR EACH ROW
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
        Schema::dropIfExists('product_behaviors');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `PRODUCT_BEHAVIOR_REF_BEFORE_INSERT`');
    }
};
