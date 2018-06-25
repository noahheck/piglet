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
            $table->text('description')->nullable();
            $table->integer('d_order');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::connection('family')->table('categories')->insert(
            [[
                'name'        => 'Food',
                'active'      => 1,
                'description' => 'Restaurants, Groceries',
                'd_order'     => '1',
            ],
            [
                'name'        => 'Housing',
                'active'      => 1,
                'description' => 'Rent/Mortgage, HOA Dues, Repairs/Maintenance',
                'd_order'     => '2',
            ],
            [
                'name'        => 'Utilities',
                'active'      => 1,
                'description' => 'Electricity, Gas, Water, Phone, Internet',
                'd_order'     => '3',
            ],
            [
                'name'        => 'Transportation',
                'active'      => 1,
                'description' => 'Car Payments, Fuel, Oil Changes, Repairs, Licenses, Taxes',
                'd_order'     => '4',
            ],
            [
                'name'        => 'Personal',
                'active'      => 1,
                'description' => 'Toiletries, Cosmetics, Household Supplies, Pet Supplies',
                'd_order'     => '5',
            ],
            [
                'name'        => 'Health Care',
                'active'      => 1,
                'description' => 'Medical/Dental/Vision, Prescriptions',
                'd_order'     => '6',
            ],
            [
                'name'        => 'Insurance',
                'active'      => 1,
                'description' => 'Medical, Dental, Vision, Life, Homeowner, Automobile Premiums',
                'd_order'     => '7',
            ],
            [
                'name'        => 'Recreation',
                'active'      => 1,
                'description' => 'Vacation, Sports, Entertainment, Subscriptions, Hobbies',
                'd_order'     => '8',
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
