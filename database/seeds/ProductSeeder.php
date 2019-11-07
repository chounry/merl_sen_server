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

        // if($isCreate == 1 || count(DB::table('users')->get()) <= 3){
        //     $userId = Str::random(20);
        //     $phone = rand(100000000,999999999);
        //     $user = DB::table('users')->find($userId);
            
        //     while($user != null){
        //         $userId = Str::random(20);
        //         $user = DB::table('users')->find($userId);
        //     }

        //     while($user != null){
        //         $phone = rand(100000000,999999999);
        //         $user = DB::table('users')->find($userId);
        //     }

        //     $user = DB::table('users')->insert([
        //         'id' => $userId,
        //         'phone' => $phone,
        //         'password' => \bcrypt('123456'),
        //         'full_name' => Str::random(5),
        //         'user_type_id' => $userTypeSellerId
        //     ]);
        // }
        
        $users = DB::table('users')->get();
        $u = $users[rand(0, count($users) - 1)];

        while($u->user_type_id != $userTypeSellerId){
            $u = $users[rand(0, count($users) - 1)];
        }
        $userId = $u->id;

        // <----------------------------- 

        $proId = Str::random(30);
        $pro = DB::table('products')->find($proId);
        while($pro != null){
            $proId = Str::random(30);
            $pro = DB::table('products')->find($proId);
        }
        DB::table('products')->insert([
            'id' => $proId,
            'sku' => "Black,Rad,Blue,Camouflage",
            'sale_price' => 179.99,
            'regular_price' => 209.95,
            'description'=> "Hear the bass, feel the bass, see the bass. Dual external passive radiators demonstrate just how powerful your speakers are
                    Splashproof means no more worrying about rain or spills; you can even clean it with running tap water. Just don't submerge it
                    Take Crystal clear calls from your speaker with the touch of a button thanks to the noise and Echo cancelling speakerphone
                    Built-in rechargeable li-ion battery supports up to 15 hours of playtime and charges devices via dual USB ports
                    Wirelessly connect up to 3 Smartphones or Tablets to the speaker and take turns playing earth-shaking, powerful stereo sound. To reset the unit, hold onto the power button and Bluetooth at the same time.",
            'title' => "JBL Xtreme Portable Wireless Bluetooth Speaker",
            'in_stock_amount' => 394,
            'phone'=> '098364728',
            'post_date'=>  '2019-10-08',
            'address'=> 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
            'user_id'=> DB::table('users')->find('1')->id
        ]);

        // can insert more than one
        // ############# Start img insertion
        $imgId = Str::random(30);
        $img = DB::table('product_imgs')->find($imgId);
        while($img != null){
            $imgId = Str::random(30);
            $img = DB::table('product_imgs')->find($imgId);
        }
        DB::table('product_imgs')->insert([
            'id'=> $imgId,
            'p_id'=> $proId,
            'url'=>'/storage/products/'.'jbl.jpeg'  
        ]);
        $imgId = Str::random(30);
        $img = DB::table('product_imgs')->find($imgId);
        while($img != null){
            $imgId = Str::random(30);
            $img = DB::table('product_imgs')->find($imgId);
        }
        DB::table('product_imgs')->insert([
            'id'=> $imgId,
            'p_id'=> $proId,
            'url'=>'/storage/products/'.'jbl1.jpeg'  
        ]);
        $imgId = Str::random(30);
        $img = DB::table('product_imgs')->find($imgId);
        while($img != null){
            $imgId = Str::random(30);
            $img = DB::table('product_imgs')->find($imgId);
        }
        DB::table('product_imgs')->insert([
            'id'=> $imgId,
            'p_id'=> $proId,
            'url'=>'/storage/products/'.'jbl2.jpeg'  
        ]);

        // ########## End Img insertion


        $cities = DB::table('cities')->get();
        DB::table('city_product')->insert([
            'city_id' => $cities[rand(0, count($cities)-1)]->id,
            'p_id' => $proId
        ]);
    
        DB::table('category_product')->insert([
            'cat_id' => '1',
            'p_id' => $proId
        ]);
        // --------------------------------->

         // <----------------------------- 

         $proId = Str::random(30);
         $pro = DB::table('products')->find($proId);
         while($pro != null){
             $proId = Str::random(30);
             $pro = DB::table('products')->find($proId);
         }
         DB::table('products')->insert([
             'id' => $proId,
             'sku' => "Rose Gold,Silver Black, Rose Gold Blue",
             'sale_price' => 20.99,
             'regular_price' => 299.95,
             'description'=> "100% New With Tag And High Quality;
                     - Top Brand Luxury High Quality Design Dial, Date Display Function;
                     - 3ATM / 30M Water Resistant (Support Cold Shower and Swim, do not operate watch when underwater, Do not support hot water);
                     - Date and Hours display 
                     - High quality leather strap
                      
                     Specifications :
                     - Case Diameter:  42mm 
                     - Case Thickness:  15mm 
                     - Band Length:  210mm
                     - Band Width:  22mm
                      
                     - Case Material: Stainless Steel
                     - Band Material: Leather
                      
                     Package Included:
                     - 1 x LIGE Watch
                     - 1 x LIGE Box
                     - 1 x Warranty Card",
             'title' => "2019 New LIGE Mens Watches Top Brand Luxury Big Dial Military Quartz Watch Casual Leather Waterproof Sport Chronograph Watch Men",
             'in_stock_amount' => 879,
             'phone'=> '098364728',
             'post_date'=>  '2019-10-08',
             'address'=> 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
             'user_id'=> DB::table('users')->find('4')->id
         ]);
 
         // can insert more than one
         // ############# Start img insertion
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'watch.jpg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'watch1.jpg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'watch2.jpg'  
         ]);
 
         // ########## End Img insertion
 
 
         $cities = DB::table('cities')->get();
         DB::table('city_product')->insert([
             'city_id' => $cities[rand(0, count($cities)-1)]->id,
             'p_id' => $proId
         ]);
     
         DB::table('category_product')->insert([
             'cat_id' => '4',
             'p_id' => $proId
         ]);
         // --------------------------------->
         // <----------------------------- 

         $proId = Str::random(30);
         $pro = DB::table('products')->find($proId);
         while($pro != null){
             $proId = Str::random(30);
             $pro = DB::table('products')->find($proId);
         }
         DB::table('products')->insert([
             'id' => $proId,
             'sku' => "Rose Gold,Silver Black, Rose Gold Blue",
             'sale_price' => 5.99,
             'regular_price' => 9.95,
             'description'=> "With a flexible felt tip applicator, Colorbar Precision Waterproof Eyeliner defines your eyes through thick and thin. The quick-drying, waterproof formula remains flawlessly intense without smudging, flaking or cracking.

             Features:
             
                 Waterproof eyeliner delivers to define your eyes
                 Delivers an intense color without flaking or smudging
                 Suitable for those with sensitive eyes and contact lenses
                 Dermatologically and ophthalmologically tested
                 Formulated in Germany
                 Free of paraben, mineral oils and formaldehydes
                 This product is vegetarian
                 Colorbar is a cruelty-free brand",
             'title' => "Colorbar Waterproof Liquid Eyeliner - Black",
             'in_stock_amount' => 652,
             'phone'=> '093542036',
             'post_date'=>  '2019-10-08',
             'address'=> 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
             'user_id'=> DB::table('users')->find('3')->id
         ]);
 
         // can insert more than one
         // ############# Start img insertion
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'eye1.jpg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'eye.png'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'eye3.jpeg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'eye2.png'  
         ]);
 
         // ########## End Img insertion
 
 
         $cities = DB::table('cities')->get();
         DB::table('city_product')->insert([
             'city_id' => $cities[rand(0, count($cities)-1)]->id,
             'p_id' => $proId
         ]);
     
         DB::table('category_product')->insert([
             'cat_id' => '3',
             'p_id' => $proId
         ]);
         // --------------------------------->

         // <----------------------------- 

         $proId = Str::random(30);
         $pro = DB::table('products')->find($proId);
         while($pro != null){
             $proId = Str::random(30);
             $pro = DB::table('products')->find($proId);
         }
         DB::table('products')->insert([
             'id' => $proId,
             'sku' => "",
             'sale_price' => 99.99,
             'regular_price' => 99.99,
             'description'=> "Hurray for Raye! The perfect family dining table this solid pine piece is super durable and shows off all the natural knots and grains of the wood. Lovely! Complete with 4 durable dining chairs, the table has a protective lacquered finish that makes it easy to wipe down.

             Part of the Raye collection.
             
             Table:
             
                 Table size H73, W75, L118cm.
                 Self-assembly - 2 people recommended. 
             
             Chair:
             
                 Includes 4 chairs.
                 Size of each chair H85, W42, D47cm.
                 Self-assembly.
                 Maximum user weight per chair 90kg.
                 Individual chair weight 4.5kg. ",
             'title' => "Argos Home Raye Solid Wood Dining Table & 4 Chairs",
             'in_stock_amount' => 879,
             'phone'=> '098364728',
             'post_date'=>  '2019-10-08',
             'address'=> 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
             'user_id'=> DB::table('users')->find('2')->id
         ]);
 
         // can insert more than one
         // ############# Start img insertion
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'table.jpeg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'table1.jpeg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'table2.jpeg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'table3.jpeg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'table4.jpeg'  
         ]);
 
         // ########## End Img insertion
 
 
         $cities = DB::table('cities')->get();
         DB::table('city_product')->insert([
             'city_id' => $cities[rand(0, count($cities)-1)]->id,
             'p_id' => $proId
         ]);
     
         DB::table('category_product')->insert([
             'cat_id' => '2',
             'p_id' => $proId
         ]);
         // --------------------------------->
         // <----------------------------- 

         $proId = Str::random(30);
         $pro = DB::table('products')->find($proId);
         while($pro != null){
             $proId = Str::random(30);
             $pro = DB::table('products')->find($proId);
         }
         DB::table('products')->insert([
             'id' => $proId,
             'sku' => "",
             'sale_price' => 99.99,
             'regular_price' => 99.99,
             'description'=> "This black sports top with mesh panels will make a great addition to their schoolwear line-up. Partner with matching bottoms for the complete look. * Black active sports top* Contrast stitching* High neck* Long sleeves* Mesh panels* Keep away from fire
             ",
             'title' => "Active Black Sports Top - 6 years",
             'in_stock_amount' => 879,
             'phone'=> '098364728',
             'post_date'=>  '2019-10-08',
             'address'=> 'Corner Street 13 & 102, SangKat Wat Phnom, Khan Da...',
             'user_id'=> DB::table('users')->find('5')->id
         ]);
 
         // can insert more than one
         // ############# Start img insertion
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'shirt.jpeg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'shirt1.jpeg'  
         ]);
         $imgId = Str::random(30);
         $img = DB::table('product_imgs')->find($imgId);
         while($img != null){
             $imgId = Str::random(30);
             $img = DB::table('product_imgs')->find($imgId);
         }
         DB::table('product_imgs')->insert([
             'id'=> $imgId,
             'p_id'=> $proId,
             'url'=>'/storage/products/'.'shirt2.jpeg'  
         ]);
         
 
         // ########## End Img insertion
 
 
         $cities = DB::table('cities')->get();
         DB::table('city_product')->insert([
             'city_id' => $cities[rand(0, count($cities)-1)]->id,
             'p_id' => $proId
         ]);
     
         DB::table('category_product')->insert([
             'cat_id' => '5',
             'p_id' => $proId
         ]);
         // --------------------------------->
        
    }
}
