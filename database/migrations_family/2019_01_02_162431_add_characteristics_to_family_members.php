<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCharacteristicsToFamilyMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->table('members', function (Blueprint $table) {

            $table->string('race')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('hair_color')->nullable();
            $table->boolean('glasses')->default(false);
            $table->boolean('contacts')->default(false);
            $table->boolean('braces')->default(false);
            $table->text('identifying_features')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('family')->table('members', function (Blueprint $table) {

            $table->dropColumn([
                'race',
                'height',
                'weight',
                'eye_color',
                'hair_color',
                'glasses',
                'contacts',
                'braces',
                'identifying_features',
            ]);

        });
    }
}
