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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('ref')->uuid();
            $table->string('name');
            $table->integer('address_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->integer('mail_id')->nullable();
            $table->integer('image_id')->nullable();
            $table->integer('doc_id')->nullable();
            $table->integer('supplier_rep_id')->nullable();
            $table->float('deposit')->default(0);
            $table->float('balance')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('suppliers');
    }
};
