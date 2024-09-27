<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('schedule_id')->constrained('schedules', 'id');
            $table->foreignId('sheet_id')->constrained('sheets', 'id');
            $table->string('email');
            $table->string('name');
            $table->boolean('is_canceled')->default(false);
            $table->timestamps();
            $table->unique(['schedule_id', 'sheet_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
