<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_models', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->longText('product_specification');
            $table->string('currency');
            $table->double('regular_price')->nullable();
            $table->double('sale_price');
            $table->bigInteger('product_quantity');
            $table->string('product_weight')->nullable();
            $table->string('product_length')->nullable();
            $table->string('product_width')->nullable();
            $table->string('product_height')->nullable();
            $table->text('product_image');
            $table->longText('long_description');
            $table->string('category_name');
            $table->string('brand_name');
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
        Schema::dropIfExists('product_models');
    }
}
