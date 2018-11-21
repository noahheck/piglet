<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFamilyForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->table('cash_flow_plan_income_sources', function (Blueprint $table) {
            $table->foreign('cash_flow_plan_id')->references('id')->on('cash_flow_plans');
            $table->foreign('income_source_id')->references('id')->on('income_sources');
        });

        Schema::connection('family')->table('cash_flow_plan_recurring_expenses', function (Blueprint $table) {
            $table->foreign('cash_flow_plan_id')->references('id')->on('cash_flow_plans');
            $table->foreign('recurring_expense_id')->references('id')->on('recurring_expenses');
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::connection('family')->table('cash_flow_plan_expense_groups', function (Blueprint $table) {
            $table->foreign('cash_flow_plan_id')->references('id')->on('cash_flow_plans');
            $table->foreign('expense_group_id')->references('id')->on('expense_groups');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::connection('family')->table('cash_flow_plan_expenses', function (Blueprint $table) {
            $table->foreign('cash_flow_plan_id')->references('id')->on('cash_flow_plans');
            $table->foreign('expense_group_id')->references('id')->on('cash_flow_plan_expense_groups');
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::connection('family')->table('cash_flow_plan_piggy_banks', function (Blueprint $table) {
            $table->foreign('cash_flow_plan_id')->references('id')->on('cash_flow_plans');
            $table->foreign('piggy_bank_id')->references('id')->on('piggy_banks');
        });

        Schema::connection('family')->table('cash_flow_plan_piggy_bank_contributions', function (Blueprint $table) {
            $table->foreign('cash_flow_plan_id')->references('id')->on('cash_flow_plans');
            $table->foreign('piggy_bank_id')->references('id')->on('cash_flow_plan_piggy_banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('family')->table('cash_flow_plan_income_sources', function (Blueprint $table) {
            $table->dropForeign('cash_flow_plan_income_sources_cash_flow_plan_id_foreign');
            $table->dropForeign('cash_flow_plan_income_sources_income_source_id_foreign');
        });

        Schema::connection('family')->table('cash_flow_plan_recurring_expenses', function (Blueprint $table) {
            $table->dropForeign('cash_flow_plan_recurring_expenses_cash_flow_plan_id_foreign');
            $table->dropForeign('cash_flow_plan_recurring_expenses_recurring_expense_id_foreign');
            $table->dropForeign('cash_flow_plan_recurring_expenses_merchant_id_foreign');
            $table->dropForeign('cash_flow_plan_recurring_expenses_category_id_foreign');
        });

        Schema::connection('family')->table('cash_flow_plan_expense_groups', function (Blueprint $table) {
            $table->dropForeign('cash_flow_plan_expense_groups_cash_flow_plan_id_foreign');
            $table->dropForeign('cash_flow_plan_expense_groups_expense_group_id_foreign');
            $table->dropForeign('cash_flow_plan_expense_groups_category_id_foreign');
        });

        Schema::connection('family')->table('cash_flow_plan_expenses', function (Blueprint $table) {
            $table->dropForeign('cash_flow_plan_expenses_cash_flow_plan_id_foreign');
            $table->dropForeign('cash_flow_plan_expenses_expense_group_id_foreign');
            $table->dropForeign('cash_flow_plan_expenses_merchant_id_foreign');
            $table->dropForeign('cash_flow_plan_expenses_category_id_foreign');
        });

        Schema::connection('family')->table('cash_flow_plan_piggy_banks', function (Blueprint $table) {
            $table->dropForeign('cash_flow_plan_piggy_banks_cash_flow_plan_id_foreign');
            $table->dropForeign('cash_flow_plan_piggy_banks_piggy_bank_id_foreign');
        });

        Schema::connection('family')->table('cash_flow_plan_piggy_bank_contributions', function (Blueprint $table) {
            $table->dropForeign('cash_flow_plan_piggy_bank_contributions_cash_flow_plan_id_foreign');
            $table->dropForeign('cash_flow_plan_piggy_bank_contributions_piggy_bank_id_foreign');
        });
    }
}
