<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user : sometimes create sometimes not
        $userTypeSellerId = DB::table('user_types')->where('name', 'Seller')->first()->id;
        $isCreate = rand(0,1);

        if($isCreate == 1 || count(DB::table('users')->get()) <= 3){
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

            $user = DB::table('users')->insert([
                'id' => $userId,
                'phone' => $phone,
                'password' => \bcrypt('123456'),
                'full_name' => Str::random(5),
                'user_type_id' => $userTypeSellerId
            ]);
        }
        
        $users = DB::table('users')->get();
        $u = $users[rand(0, count($users) - 1)];

        while($u->user_type_id != $userTypeSellerId){
            $u = $users[rand(0, count($users) - 1)];
        }
        $userId = $u->id;
        $products = [
            [
            'id' => Str::random(30),
            'sku'=> "Black,Rad,Blue,Camouflage",
            'sale_price' => 179.99,
            'regular_price' => 209.95,
            'description'=> " Hear the bass, feel the bass, see the bass. Dual external passive radiators demonstrate just how powerful your speakers are
            Splashproof means no more worrying about rain or spills; you can even clean it with running tap water. Just don't submerge it
            Take Crystal clear calls from your speaker with the touch of a button thanks to the noise and Echo cancelling speakerphone
            Built-in rechargeable li-ion battery supports up to 15 hours of playtime and charges devices via dual USB ports
            Wirelessly connect up to 3 Smartphones or Tablets to the speaker and take turns playing earth-shaking, powerful stereo sound. To reset the unit, hold onto the power button and Bluetooth at the same time. ",
            'title' => "JBL Xtreme Portable Wireless Bluetooth Speaker",
            'in_stock_amount'=> 394,
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ],
        [
            'id' => Str::random(30),
            'sku' => Str::random(10),
            'sale_price' => rand(10, 500). '.'. rand(0, 99),
            'regular_price' => rand(10, 500). '.'. rand(0, 99),
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> rand(0, 500),
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => $userId,
        ]
    ];

        $imgUrls = ['car-default-1.jpg','car-default-2.jpg','car-default-3.jpg','car-default-4.jpg',
                'computer-default-1.jpg','computer-default-2.jpg','computer-default-3.jpg','computer-default-4.jpeg',
                'mouse-default-1.jpg','mouse-default-2.jpg','table-default-1.jpg','umbrella_first.jpb'
        ];
        foreach ($products as $product ) {
            $pro_id = $product['id'];
        if(DB::table('products')->where('id',$pro_id)->first() == null){
            DB::table('products')->insert([
                'id' => $pro_id,
                'sku' => $product['sku'],
                'sale_price' => $product['sale_price'],
                'regular_price' => $product['regular_price'],
                'description'=>$product['description'],
                'title' => $product['title'],
                'in_stock_amount' => $product['in_stock_amount'],
                'phone'=>$product['phone'],
                'post_date'=>$product['date'],
                'address'=>$product['address'],
                'user_id'=>$product['user_id']
            ]);
            

            $numOfImgToSave = rand(2, count($imgUrls)-1);
            $currendAmount = 0;
            foreach($imgUrls as $imgUrl){
                $currendAmount++;
                if($currendAmount == $numOfImgToSave){
                    break;
                }
                 
                DB::table('product_imgs')->insert([
                    'id'=> Str::random(20),
                    'p_id'=> $pro_id,
                    'url'=>'/storage/products/'.$imgUrl
                ]);
            };

            $cities = DB::table('cities')->get();
            DB::table('city_product')->insert([
                'city_id' => $cities[rand(0, count($cities)-1)]->id,
                'p_id' => $pro_id
            ]);
            
            $numOfCateCouldHave = rand(1, 3);  
            $randomArrTmp = [];
            $categories = DB::table('categories')->get();
            for($j = 0; $j < $numOfCateCouldHave; $j++){
                $random = 1;
                while(in_array($random, $randomArrTmp)){
                    $random = rand(0, count($categories)-1);
                }
                $randomArrTmp[] = $random;
                DB::table('category_product')->insert([
                    'cat_id' => $categories[$random]->id,
                    'p_id' => $pro_id
                ]);
            }
        }
        }
        
    }
}
