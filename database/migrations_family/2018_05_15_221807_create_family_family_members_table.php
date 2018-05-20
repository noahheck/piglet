<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyFamilyMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName')->default('');
            $table->string('middleName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('suffix')->nullable();
            $table->string('nickname')->nullable();
            $table->date('birthdate')->nullable();
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
        Schema::dropIfExists('members');
    }
}
