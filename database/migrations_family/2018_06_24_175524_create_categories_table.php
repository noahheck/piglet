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
            $table->text('sub_categories')->default('[]')->nullable();
            $table->integer('d_order');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::connection('family')->table('categories')->insert(
            [[
                'name'           => 'Food',
                'active'         => 1,
                'description'    => 'Food expenses',
                'd_order'        => '1',
                'sub_categories' => '["Groceries","Restaurants"]',
            ],
            [
                'name'           => 'Housing',
                'active'         => 1,
                'description'    => "Expenses related to owning or renting your home and it's upkeep",
                'd_order'        => '2',
                'sub_categories' => '["Mortgage","Rent","Repairs","Maintenance","Taxes","HOA Dues"]',
            ],
            [
                'name'           => 'Utilities',
                'active'         => 1,
                'description'    => 'Expenses related to operating the equipment in your home',
                'd_order'        => '3',
                'sub_categories' => '["Electricity","Gas","Water","Cable","Internet"]',
            ],
            [
                'name'           => 'Transportation',
                'active'         => 1,
                'description'    => 'Expenses related to maintaining your vehicle or using public transportation',
                'd_order'        => '4',
                'sub_categories' => '["Car Payment","Bus Pass","Taxi","Fuel","Oil Changes","Repairs","Licenses","Taxes"]',
            ],
            [
                'name'           => 'Personal',
                'active'         => 1,
                'description'    => 'Household/Living expenses',
                'd_order'        => '5',
                'sub_categories' => '["Toiletries","Cosmetics","Household Supplies","Pet Supplies"]',
            ],
            [
                'name'           => 'Health Care',
                'active'         => 1,
                'description'    => 'Expenses for your professional healthcare services',
                'd_order'        => '6',
                'sub_categories' => '["Medical","Dental","Vision","Prescriptions","Orthodontic"]',
            ],
            [
                'name'           => 'Insurance',
                'active'         => 1,
                'description'    => 'Premiums paid for maintaining insurance policies',
                'd_order'        => '7',
                'sub_categories' => '["Medical","Dental","Vision","Life","Homeowner","Automobile"]',
            ],
            [
                'name'           => 'Recreation',
                'active'         => 1,
                'description'    => 'All the things that make life worth living',
                'd_order'        => '8',
                'sub_categories' => '["Vacation","Sports","Entertainment","Subscriptions","Hobbies"]',
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
