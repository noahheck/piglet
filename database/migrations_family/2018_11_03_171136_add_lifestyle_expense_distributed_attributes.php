<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLifestyleExpenseDistributedAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->table('cash_flow_plans', function (Blueprint $table) {

            $table->boolean('pocket_money_distributed')->default(false)->after('pocket_money');
            $table->boolean('retirement_distributed')->default(false)->after('retirement');
            $table->boolean('education_distributed')->default(false)->after('education');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('family')->table('cash_flow_plans', function (Blueprint $table) {

            $table->dropColumn([
                'pocket_money_distributed',
                'retirement_distributed',
                'education_distributed',
            ]);

        });
    }
}
