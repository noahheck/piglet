<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->table('cash_flow_plan_expense_groups', function (Blueprint $table) {

            $table->boolean('cash')->default(false);

        });

        Schema::connection('family')->table('expense_groups', function (Blueprint $table) {

            $table->boolean('cash')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('family')->table('cash_flow_plan_expense_groups', function (Blueprint $table) {

            $table->dropColumn('cash');

        });

        Schema::connection('family')->table('expense_groups', function (Blueprint $table) {

            $table->dropColumn('cash');

        });
    }
}
