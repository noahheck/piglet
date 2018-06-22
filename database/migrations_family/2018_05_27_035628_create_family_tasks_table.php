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
            $table->text('details')->nullable();
            $table->integer('member_id')->nullable();
            $table->integer('task_list_id')->nullable();
            $table->boolean('active')->default(true);

            $table->date('dueDate')->nullable();
            $table->date('scheduledDate')->nullable();

            $table->boolean('completed')->default(false);
            $table->dateTime('completed_at')->nullable();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('task_list_id')->references('id')->on('task_lists');

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
        Schema::connection('family')->dropIfExists('tasks');
    }
}
