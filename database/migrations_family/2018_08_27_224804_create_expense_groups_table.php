<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('expense_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active');
            $table->float('default_amount')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('sub_category')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('family')->dropIfExists('expense_groups');
    }
}
