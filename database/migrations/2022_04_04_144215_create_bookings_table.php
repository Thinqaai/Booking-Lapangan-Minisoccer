<?php

use App\Models\Arena;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('arena_id');
            $table->unsignedInteger('user_id');
            $table->datetime('time_from');
            $table->datetime('time_to');
            $table->tinyInteger('status')->default(0);
            $table->integer('grand_total')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('arena_id')->references('id')->on('arenas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}