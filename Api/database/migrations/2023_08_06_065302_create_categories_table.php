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
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->string('name_eng')->nullable();
            $table->string('name_uni')->nullable();
            $table->string('short_code')->nullable();
            $table->string('description')->nullable();
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('updated_by')->nullable();
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `CATEGORY_REF_BEFORE_INSERT` BEFORE INSERT ON `categories` FOR EACH ROW
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
        Schema::dropIfExists('categories');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `CATEGORY_REF_BEFORE_INSERT`');
    }
};
