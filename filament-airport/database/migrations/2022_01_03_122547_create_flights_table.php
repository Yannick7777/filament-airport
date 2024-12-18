<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string("number");
            $table->boolean('ready')->default(false);
            $table->boolean('boarding')->default(false);
            $table->boolean('boarding-finished')->default(false);
            $table->boolean('flying')->default(false);
            $table->dateTime('departure_date');
            $table->dateTime('arrival_date');
            $table->foreignId('airplane_id');
            $table->foreignId('start_airport_id');
            $table->foreignId('end_airport_id');
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
        Schema::dropIfExists('flights');
    }
}
