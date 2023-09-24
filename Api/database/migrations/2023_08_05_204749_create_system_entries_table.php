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
        Schema::create('system_entries', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique()->default(DB::raw('(UUID())'));
            $table->integer('employee_id')->nullable();
            $table->integer('device_id')->nullable();
            $table->tinyInteger('is_in')->default(1);
            $table->dateTime('at')->useCurrent();
            $table->tinyInteger('status')->default(1)->comment('active = 1, inactive = 0');
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `SYSTEM_ENTRY_REF_BEFORE_INSERT` BEFORE INSERT ON `system_entries` FOR EACH ROW
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
        Schema::dropIfExists('system_entries');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `SYSTEM_ENTRY_REF_BEFORE_INSERT`');
    }
};
