<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveProjectedFromExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->table('cash_flow_plan_expenses', function (Blueprint $table) {

            $table->dropColumn('projected');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('family')->table('cash_flow_plan_expenses', function (Blueprint $table) {

            $table->decimal('projected')->nullable();

        });
    }
}
