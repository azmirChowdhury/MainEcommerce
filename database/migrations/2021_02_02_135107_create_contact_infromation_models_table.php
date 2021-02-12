<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactInfromationModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_infromation_models', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone_number',100)->nullable();
            $table->string('telephone_number',100)->nullable();
            $table->bigInteger('fax')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('contact_infromation_models');
    }
}
