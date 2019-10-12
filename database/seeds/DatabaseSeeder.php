<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // user type
        $names = ['Admin', 'Member', 'Seller'];
        foreach($names as $n){
            DB::table('user_types')->insert([
                'id' => Str::random(5),
                'name' => $n
            ]);
        }

        // Category
        $categories = ['Electronic', 'Furniture', 'Cosmetics','Clothes','Sport'];
        foreach($categories as $cat){
            DB::table('categories')->insert([
                'id' => Str::random(5),
                'name' => $cat
            ]); 
        }


        // city
        $cities = ['Phnom Penh', 'Siem Reap', 'Kampong Thom','Kampong Cham','Kampot'];
        foreach($cities as $city){
            DB::table('cities')->insert([
                'id' => Str::random(5),
                'name' => $city
            ]); 
        }
    }
}
