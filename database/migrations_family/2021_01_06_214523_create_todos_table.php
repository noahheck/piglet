<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('todos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 1024);
            $table->text('details')->nullable();
            $table->boolean('active')->default(true);
            $table->date('due_date')->nullable();
            $table->date('scheduled_date')->nullable();
            $table->date('completed')->nullable();
            $table->boolean('private')->default(false);
            $table->bigInteger('created_by');

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
        Schema::connection('family')->dropIfExists('todos');
    }
}
