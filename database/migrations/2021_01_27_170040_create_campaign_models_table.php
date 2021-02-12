<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_models', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');
            $table->text('campaign_description');
            $table->tinyInteger('discount_type');
            $table->integer('discount_amount');
            $table->string('campaign_start');
            $table->string('campaign_end');
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
        Schema::dropIfExists('campaign_models');
    }
}
