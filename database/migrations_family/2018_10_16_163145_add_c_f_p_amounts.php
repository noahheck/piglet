<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCFPAmounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->table('cash_flow_plans', function (Blueprint $table) {
            $table->decimal('pocket_money')->nullable();
            $table->decimal('retirement')->nullable();
            $table->decimal('education')->nullable();
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
            $table->dropColumn('pocket_money');
            $table->dropColumn('retirement');
            $table->dropColumn('education');
        });
    }
}
