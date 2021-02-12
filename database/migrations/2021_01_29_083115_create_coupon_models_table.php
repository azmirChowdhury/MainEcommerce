<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_models', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code');
            $table->text('coupon_description');
            $table->tinyInteger('discount_type');
            $table->integer('discount_amount');
            $table->date('expire_date');
            $table->integer('minimum_spend');
            $table->integer('maximum_spend');
            $table->integer('limit_per_coupon');
            $table->integer('limit_per_user');
            $table->text('category_id')->nullable();
            $table->text('product_id')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_models');
    }
}
