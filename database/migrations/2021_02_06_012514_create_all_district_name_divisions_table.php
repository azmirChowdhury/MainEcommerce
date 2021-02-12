<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllDistrictNameDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_district_name_divisions', function (Blueprint $table) {
            $table->id();
            $table->string('country')->default('Bangladesh');
            $table->string('division_name');
            $table->string('district_name');
            $table->tinyInteger('use_status')->default(0);
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
        Schema::dropIfExists('all_district_name_divisions');
    }
}
