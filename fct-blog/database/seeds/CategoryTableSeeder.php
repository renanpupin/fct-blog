<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert(array(
            array(
                'id' => 1,
                'name' => 'Android',
                'slug' => 'android'
            ),
            array(
                'id' => 2,
                'name' => 'Front-end',
                'slug' => 'front-end'
            ),
            array(
                'id' => 3,
                'name' => 'Banco de dados',
                'slug' => 'banco-de-dados'
            )
        ));
    }
}
