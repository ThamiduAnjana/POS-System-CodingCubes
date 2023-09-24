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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique()->default(DB::raw('(UUID())'));
            $table->string('name')->nullable();
            $table->integer('credential_id')->nullable();
            $table->integer('access_policy_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('active = 1, inactive = 0');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('updated_by')->nullable();
        });

        //Trigger
        DB::statement(
            'CREATE TRIGGER `SUBSCRIPTION_REF_BEFORE_INSERT` BEFORE INSERT ON `subscriptions` FOR EACH ROW
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
        Schema::dropIfExists('subscriptions');

        //Trigger
        DB::statement('DROP TRIGGER IF EXISTS `SUBSCRIPTION_REF_BEFORE_INSERT`');
    }
};
