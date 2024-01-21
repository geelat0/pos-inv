<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id('sched_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('sched_1')->default(0);
            $table->boolean('sched_2')->default(0);
            $table->boolean('sched_3')->default(0);
            $table->boolean('sched_4')->default(0);
            $table->boolean('sched_5')->default(0);
            $table->boolean('sched_6')->default(0);
            $table->boolean('sched_7')->default(0);

            // Add foreign key constraints if necessary
            $table->foreign('user_id')->references('id')->on('users');
            // Add additional foreign key constraints for sched_1 to sched_7 if necessary

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
        Schema::dropIfExists('schedule');
    }
}
