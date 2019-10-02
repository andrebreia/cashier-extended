<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionCouponsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subscription_coupons', function ($table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->comment('Stripe ID');
            $table->unsignedInteger('amount_off')->nullable();
            $table->decimal('percent_off', 5, 2)->nullable();
            $table->enum('duration', ['forever', 'once', 'repeating'])->default('once');
            $table->string('duration_in_months')->nullable();
            $table->unsignedInteger('max_redemptions');
            $table->timestamp('redeem_by')->nullable();
            $table->boolean('valid')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('subscription_coupons');
    }
}
