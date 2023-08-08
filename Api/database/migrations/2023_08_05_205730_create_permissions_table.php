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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->integer('resource_id')->nullable();
            $table->integer('access_policy_id')->nullable();
            $table->tinyInteger('read')->default(0);
            $table->tinyInteger('write')->default(0);
            $table->tinyInteger('update')->default(0);
            $table->tinyInteger('delete')->default(0);
            $table->tinyInteger('approve')->default(0);
            $table->tinyInteger('reject')->default(0);
            $table->tinyInteger('cancel')->default(0);
            $table->tinyInteger('share')->default(0);
            $table->tinyInteger('download')->default(0);
            $table->tinyInteger('upload')->default(0);
            $table->tinyInteger('print')->default(0);
            $table->tinyInteger('export')->default(0);
            $table->tinyInteger('import')->default(0);
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
        Schema::dropIfExists('permissions');
    }
};
