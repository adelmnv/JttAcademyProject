<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPracticesTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_practices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('practice_id');
            $table->unsignedBigInteger('coach_id');
            $table->string('days_of_week');
            $table->time('time');
            $table->tinyInteger('duration')->default(1);
            $table->tinyInteger('court_number');
            $table->integer('capacity')->default(6);
            $table->timestamps();

            $table->foreign('practice_id')->references('id')->on('practices')->onDelete('cascade');
            $table->foreign('coach_id')->references('id')->on('coaches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_practices');
    }
}
