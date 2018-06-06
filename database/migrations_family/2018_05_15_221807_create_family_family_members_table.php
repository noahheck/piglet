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
            $table->integer('family');
            $table->integer('user_id')->nullable();
            $table->string('firstName')->default('');
            $table->string('middleName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('suffix')->nullable();
            $table->string('nickname')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('image_updated_at')->nullable();
            $table->string('color')->nullable();
            $table->boolean('allow_login')->default(false);
            $table->string('login_email')->nullable();
            $table->boolean('is_administrator')->default(false);
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
