<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashFlowPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('cash_flow_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->integer('month');
            $table->text('details')->nullable();
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
        Schema::connection('family')->dropIfExists('cash_flow_plans');
    }
}
