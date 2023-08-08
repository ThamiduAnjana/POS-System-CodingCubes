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
        Schema::create('devices', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->string('name')->nullable();
            $table->string('mac')->nullable();
            $table->string('ip')->nullable();
            $table->tinyInteger('type')->default(0)->comment('0:admin, 1: management, 2:hr, 2: accounts, 3:warehouse, 4: sales');
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
        Schema::dropIfExists('devices');
    }
};
