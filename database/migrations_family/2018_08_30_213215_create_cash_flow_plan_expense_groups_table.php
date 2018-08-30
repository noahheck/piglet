<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashFlowPlanExpenseGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('cash_flow_plan_expense_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cash_flow_plan_id');
            $table->integer('expense_group_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('name');
            $table->decimal('projected')->nullable();
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
        Schema::dropIfExists('cash_flow_plan_expense_groups');
    }
}
