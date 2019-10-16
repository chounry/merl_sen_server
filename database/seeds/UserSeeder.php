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
        $phone = rand(100000000,999999999);
        $user = DB::table('users')->find($userId);
        
        while($user != null){
            $userId = Str::random(20);
            $user = DB::table('users')->find($userId);
        }

        while($user != null){
            $phone = rand(100000000,999999999);
            $user = DB::table('users')->find($userId);
        }

        DB::table('users')->insert([
            'id' => $userId,
            'phone' => $phone,
            'password' => \bcrypt('123456'),
            'full_name' => 'veng',
            'user_type_id' => DB::table('user_types')->where('name', 'Member')->first()->id
        ]);
    }
}
