<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->text('details')->nullable();
            $table->date('date');
            $table->time('time')->nullable();
            $table->boolean('all_day')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('family')->dropIfExists('events');
    }
}
