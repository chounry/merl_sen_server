<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = Str::random(20);
        $phone = "011111111";
        $user = DB::table('users')->find($userId);
        
        while($user != null){
            $userId = Str::random(20);
            $user = DB::table('users')->find($userId);
        }

        DB::table('users')->insert([
            'id' => $userId,
            'phone' => $phone,
            'password' => \bcrypt('123456'),
            'full_name' => 'veng',
            'user_type_id' => DB::table('user_types')->where('name', 'Member')->first()->id
        ]);


        DB::table('users')->insert([
            'id' => '1',
            'phone' => "011111112",
            'password' => \bcrypt('123456'),
            'full_name' => 'JBL Show Room',
            "profile_img"=> "/storage/users/jblshop.jpg",
            'user_type_id' => DB::table('user_types')->where('name', 'Seller')->first()->id
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'phone' => "011111113",
            'password' => \bcrypt('123456'),
            'full_name' => 'Home & Furniture',
            "profile_img"=> "/storage/users/jblshop.jpg",
            'user_type_id' => DB::table('user_types')->where('name', 'Seller')->first()->id
        ]);

        DB::table('users')->insert([
            'id' => '3',
            'phone' => "011111114",
            'password' => \bcrypt('123456'),
            'full_name' => 'Cosmictic',
            "profile_img"=> "/storage/users/jblshop.jpg",
            'user_type_id' => DB::table('user_types')->where('name', 'Seller')->first()->id
        ]);
        DB::table('users')->insert([
            'id' => '4',
            'phone' => "011111115",
            'password' => \bcrypt('123456'),
            'full_name' => 'Fashion de mode',
            "profile_img"=> "/storage/users/jblshop.jpg",
            'user_type_id' => DB::table('user_types')->where('name', 'Seller')->first()->id
        ]);
        DB::table('users')->insert([
            'id' => '5',
            'phone' => "011111116",
            'password' => \bcrypt('123456'),
            'full_name' => 'Home Sport',
            "profile_img"=> "/storage/users/jblshop.jpg",
            'user_type_id' => DB::table('user_types')->where('name', 'Seller')->first()->id
        ]);
    }
}
