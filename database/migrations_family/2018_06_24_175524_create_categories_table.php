<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('family')->create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active');
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->text('sub_categories')->default('[]')->nullable();
            $table->integer('d_order');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::connection('family')->table('categories')->insert(
            [[
                'name'           => __('categories.default.food'),
                'active'         => 1,
                'color'          => '#FD1F1F',
                'description'    => __('categories.default.food.desc'),
                'd_order'        => '1',
                'sub_categories' => __('categories.default.food.subs'),
            ],
            [
                'name'           => __('categories.default.housing'),
                'active'         => 1,
                'color'          => '#0047ED',
                'description'    => __('categories.default.housing.desc'),
                'd_order'        => '2',
                'sub_categories' => __('categories.default.housing.subs'),
            ],
            [
                'name'           => __('categories.default.utilities'),
                'active'         => 1,
                'color'          => '#ED8D1A',
                'description'    => __('categories.default.utilities.desc'),
                'd_order'        => '3',
                'sub_categories' => __('categories.default.utilities.subs'),
            ],
            [
                'name'           => __('categories.default.transportation'),
                'active'         => 1,
                'color'          => '#CF258F',
                'description'    => __('categories.default.transportation.desc'),
                'd_order'        => '4',
                'sub_categories' => __('categories.default.transportation.subs'),
            ],
            [
                'name'           => __('categories.default.personal'),
                'active'         => 1,
                'color'          => '#1A9B3C',
                'description'    => __('categories.default.personal.desc'),
                'd_order'        => '5',
                'sub_categories' => __('categories.default.personal.subs'),
            ],
            [
                'name'           => __('categories.default.healthcare'),
                'active'         => 1,
                'color'          => '#E7EA51',
                'description'    => __('categories.default.healthcare.desc'),
                'd_order'        => '6',
                'sub_categories' => __('categories.default.healthcare.subs'),
            ],
            [
                'name'           => __('categories.default.insurance'),
                'active'         => 1,
                'color'          => '#75ABAB',
                'description'    => __('categories.default.insurance.desc'),
                'd_order'        => '7',
                'sub_categories' => __('categories.default.insurance.subs'),
            ],
            [
                'name'           => __('categories.default.recreation'),
                'active'         => 1,
                'color'          => '#2FE8E3',
                'description'    => __('categories.default.recreation.desc'),
                'd_order'        => '8',
                'sub_categories' => __('categories.default.recreation.subs'),
            ]]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('family')->dropIfExists('categories');
    }
}
