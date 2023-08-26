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
        Schema::create('documents', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->tinyInteger('who_is')->default(5)->comment('0=employee, 1=customer, 2=supplier, 3=supplier_rep, 4=product, 5=other');
            $table->integer('who_id');
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('updated_by')->nullable();
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `DOCUMENT_REF_BEFORE_INSERT` BEFORE INSERT ON `documents` FOR EACH ROW
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
        Schema::dropIfExists('documents');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `DOCUMENT_REF_BEFORE_INSERT`');
    }
};
