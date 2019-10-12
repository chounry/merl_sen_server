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
        $products = [[
            'id' => Str::random(30),
            'sku'=> Str::random(10),
            'sale_price' => 15.0,
            'regular_price' => 20.0,
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> 100,
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => ';klajsdsadf',
        ],[
            'id' => Str::random(30),
            'sku'=> Str::random(10),
            'sale_price' => 15.0,
            'regular_price' => 20.0,
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> 100,
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => ';klajsdsadf',
        ],
        [
            'id' => Str::random(30),
            'sku'=> Str::random(10),
            'sale_price' => 15.0,
            'regular_price' => 20.0,
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> 100,
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => ';klajsdsadf',
        ],[
            'id' => Str::random(30),
            'sku'=> Str::random(10),
            'sale_price' => 15.0,
            'regular_price' => 20.0,
            'description'=> Str::random(100),
            'title' => Str::random(8),
            'in_stock_amount'=> 100,
            'phone'=> '09123587' ,
            'date'=>' 2019-10-08',
            'address' => 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id' => ';klajsdsadf',
        ]];

        $imgUrls = ['car-default-1.jpg','car-default-2.jpg','car-default-3.jpg','car-default-4.jpg',
                'computer-default-1.jpg','computer-default-2.jpg','computer-default-3.jpg','computer-default-4.jpeg',
                'mouse-default-1.jpg','mouse-default-2.jpg','table-default-1.jpg','umbrella_first.jpb'
        ];

        for($i = 0;$i < 10; $i++){
            foreach($products as $pro){
                $pro_id = $pro['id'];
                if(DB::table('products')->where('id',$pro_id)->first() == null){
                    DB::table('products')->insert([
                        'id' => $pro_id,
                        'sku' => $pro['sku'],
                        'sale_price' => $pro['sale_price'],
                        'regular_price' => $pro['regular_price'],
                        'description'=>$pro['description'],
                        'title' => $pro['title'],
                        'in_stock_amount' => $pro['in_stock_amount'],
                        'phone'=>$pro['phone'],
                        'post_date'=>$pro['date'],
                        'address'=>$pro['address'],
                        'user_id'=>$pro['user_id']
                    ]);
                    
                    DB::table('product_imgs')->insert([
                        'id'=> Str::random(20),
                        'p_id'=> $pro_id,
                        'url'=>'/storage/products/'.$imgUrls[rand(0, count($imgUrls)-1)]
                    ]);

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
}
