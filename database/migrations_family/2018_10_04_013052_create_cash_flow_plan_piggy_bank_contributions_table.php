<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashFlowPlanPiggyBankContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('cash_flow_plan_piggy_bank_contributions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cash_flow_plan_id');
            $table->integer('piggy_bank_id');
            $table->decimal('actual')->nullable();
            $table->date('date')->nullable();
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
        Schema::connection('family')->dropIfExists('cash_flow_plan_piggy_bank_contributions');
    }
}
