<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create(); //import lib

        $limit = 10;


        for ($i=0; $i < $limit; $i++) {
            DB::table('items')->insert([
                'nama'      =>  $faker->city,
                'harga'     =>  $faker->randomNumber,
                'stok'    =>  $faker->randomNumber
            ]);
        }        

 
    }
}
