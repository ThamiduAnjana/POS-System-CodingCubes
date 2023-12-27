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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('media_ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('owner_type')->default(1)->comment('1 = employee, 2 = customer, 3 = supplier, 4 = supplier representative, 5 = product');
            $table->integer('owner_id')->nullable();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('extension')->nullable();
            $table->integer('media_type_id')->nullable()->comment('profile,cover,educational,medical,other');
            $table->string('folder_name')->nullable();
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
        Schema::dropIfExists('media');
    }
};
