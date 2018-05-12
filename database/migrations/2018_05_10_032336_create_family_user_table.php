<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('family_id');
            $table->unsignedInteger('user_id');
            $table->boolean('active')->default(true);
            $table->boolean('isAdministrator')->default(false);
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_user');
    }
}
