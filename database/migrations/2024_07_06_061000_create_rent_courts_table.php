<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentCourtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_courts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('practice_id')->default(5);
            $table->unsignedBigInteger('client_id');
            $table->date('date');
            $table->time('time');
            $table->tinyInteger('duration')->default(1);
            $table->tinyInteger('court_number');
            $table->timestamps();

            $table->foreign('practice_id')->references('id')->on('practices')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_courts');
    }
}
