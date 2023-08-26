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
        Schema::create('supplier_representatives', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ref')->uuid();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('initials')->nullable();
            $table->tinyInteger('sex')->nullable();
            $table->string('nic')->nullable();
            $table->string('passport')->nullable();
            $table->string('driving_license')->nullable();
            $table->date('dob')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('updated_by')->nullable();
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `SUPPLIER_REPRESENTATIVE_REF_BEFORE_INSERT` BEFORE INSERT ON `supplier_representatives` FOR EACH ROW
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
        Schema::dropIfExists('supplier_representatives');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `SUPPLIER_REPRESENTATIVE_REF_BEFORE_INSERT`');
    }
};
