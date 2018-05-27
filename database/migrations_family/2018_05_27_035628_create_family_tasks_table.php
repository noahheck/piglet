<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('details')->default('');
            $table->integer('responsibleFor')->nullable();
            $table->integer('taskList')->nullable();
            $table->boolean('active')->default(true);
            $table->date('dueDate')->nullable();
            $table->date('scheduledDate')->nullable();
            $table->date('completedDate')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}