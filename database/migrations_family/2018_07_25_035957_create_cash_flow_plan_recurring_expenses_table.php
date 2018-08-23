<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashFlowPlanRecurringExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('cash_flow_plan_recurring_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cash_flow_plan_id');
            $table->integer('recurring_expense_id');
            $table->integer('merchant_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('name');
            $table->decimal('projected')->nullable();
            $table->decimal('actual')->nullable();
            $table->date('date')->nullable();
            $table->string('payment_detail')->nullable();
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
        Schema::connection('family')->dropIfExists('cash_flow_plan_recurring_expenses');
    }
}
