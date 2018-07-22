<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashFlowPlanIncomeSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('cash_flow_plan_income_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cash_flow_plan_id');
            $table->integer('income_source_id')->nullable();
            $table->string('type')->default('budget');
            $table->string('name');
            $table->decimal('amount');
            $table->text('detail')->nullable();
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
        Schema::connection('family')->dropIfExists('cash_flow_plan_income_sources');
    }
}
