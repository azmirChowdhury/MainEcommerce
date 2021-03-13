<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('notifiable_type')->index();
            $table->bigInteger('notifiable_id')->index();
            $table->text('data');
            $table->dateTime('read_at');
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
        Schema::dropIfExists('all_notifications');
    }
}
