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

        while($user != null){
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
