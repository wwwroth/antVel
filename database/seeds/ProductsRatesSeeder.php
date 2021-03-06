<?php

/**
 * Antvel - Seeder
 * Products Rates Table
 *
 * @author  Gustavo Ocanto <gustavoocanto@gmail.com>
 */

use App\Address;
use App\Business;
use App\Category;
use App\Order;
use App\Person;
use App\Product;
use App\User;
use App\UserPoints;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductsRatesSeeder extends Seeder
{
    public function run()
    {
        $faker=Faker::create();
        $user=Person::create([
            'first_name'=>$faker->firstName,
            'last_name'=>$faker->lastName,
            'birthday'=>$faker->dateTimeBetween('-40 years', '-16 years'),
            'sex'=>$faker->randomElement(['male', 'female']),
            'user'=>[
                'nickname'=>'seededuser',
                'email'=>'user@gmail.com',
                'password'=>Hash::make('123456'),
                'pic_url'=>'/pt-default/'.$faker->numberBetween(1, 20).'.jpg',
                'twitter'=>'@'.$faker->userName,
                'facebook'=>$faker->userName
            ]
        ])->user;
        for ($j=0; $j < 2; $j++) {
            $userPoints = UserPoints::create([
                'user_id' => $user->id,
                'action_type_id' => 6,
                'source_id' => 1,
                'points' => 10000,
            ]);
        };

        $userAddress=Address::create([
            'user_id'=>$user->id,
            'default'=>1,
            'line1'=>$faker->streetAddress,
            'line2'=>$faker->streetAddress,
            'phone'=>$faker->phoneNumber,
            'name_contact'=>$faker->streetName,
            'zipcode'=>$faker->postcode,
            'city'=>$faker->city,
            'country'=>$faker->country,
            'state'=>$faker->state,

        ]);

        $company_name = 'seededinc_inc';
        $enterprise = Business::create([
            'business_name'=>$company_name,
            'creation_date'=>$faker->date(),
            'local_phone'=>$faker->phoneNumber,
            'user'=>[
                'nickname'=>'seededinc',
                'email'=>'octasan.trabajo@gmail.com',
                'password'=>Hash::make('123456'),
                'pic_url'=>'/pt-default/'.$faker->numberBetween(1, 20).'.jpg',
                'twitter'=>'@'.$company_name,
                'facebook'=>$company_name,
            ]
        ])->user;

        $catforseed = Category::where('type', 'store')->first();
        $seededProduct=Product::create([
            'category_id'=>$catforseed->id,
            'user_id'=> '3', //$enterprise->id,
            'name'=>'My Seeded Product',
            'description'=>$faker->text(90),
            'price'=>$faker->randomNumber(2),
            'stock'=>100,
            'brand'=>$faker->randomElement(['Apple', 'Gigabyte', 'Microsoft', 'Google. Inc', 'Samsung', 'Lg']),
            'features'=>json_encode([
                    "images"=>[
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg'
                    ],
                    "weight"=>$faker->numberBetween(10, 150).' '.$faker->randomElement(["Mg", "Gr", "Kg", "Oz", "Lb"]),
                    "dimensions"=>$faker->numberBetween(1, 30).' X '.
                                  $faker->numberBetween(1, 30).' X '.
                                  $faker->numberBetween(1, 30).' '.
                                  $faker->randomElement(["inch", "mm", "cm"]),
                    "color"=>$faker->safeColorName
                    ]),
            'condition'=>$faker->randomElement(['new', 'refurbished', 'used']),
            //'currency'=>0,
            'low_stock'=>$faker->randomElement([5, 10, 15]),
            'rate_val'=>'3',
            'rate_count'=>'5',
            'tags' => $faker->word.','.$faker->word.','.$faker->word
        ]);

        for ($j=0;$j<5;$j++) {
            Order::create([
                'user_id'=>$user->id,
                'seller_id' => '3',
                'address_id'=>$userAddress->id,
                'status'=>'closed',
                'type'=>'order',
                'description'=>'',
                'seller_id'=>$enterprise->id,
                'end_date'=>$faker->dateTime(),
                'detail'=>[
                    'product_id'=>$seededProduct->id,
                    'price'=>$seededProduct->price,
                    'quantity'=>'1',
                    'delivery_date'=>$faker->dateTime(),
                    'rate'=>$faker->numberBetween(1, 5),
                    'rate_comment'=>$faker->text(90)
                ]
            ]);
        }

        $seededProduct2=Product::create([
            'category_id'=>$catforseed->id,
            'user_id'=> '3', //$enterprise->id,
            'name'=>'Another Seeded Product',
            'description'=>$faker->text(90),
            'price'=>$faker->randomNumber(2),
            'brand'=>$faker->randomElement(['Apple', 'Gigabyte', 'Microsoft', 'Google. Inc', 'Samsung', 'Lg']),
            'stock'=>100,
            'features'=>json_encode([
                    "images"=>[
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg'
                    ],
                    "weight"=>$faker->numberBetween(10, 150).' '.$faker->randomElement(["Mg", "Gr", "Kg", "Oz", "Lb"]),
                    "dimensions"=>$faker->numberBetween(1, 30).' X '.
                                  $faker->numberBetween(1, 30).' X '.
                                  $faker->numberBetween(1, 30).' '.
                                  $faker->randomElement(["inch", "mm", "cm"]),
                    "color"=>$faker->safeColorName
                    ]),
            'condition'=>$faker->randomElement(['new', 'refurbished', 'used']),
            //'currency'=>0,
            'low_stock'=>$faker->randomElement([5, 10, 15]),
            'rate_val'=>'4',
            'rate_count'=>'5',
            'tags' => $faker->word.','.$faker->word.','.$faker->word
        ]);

        $seededProduct3=Product::create([
            'category_id'=>$catforseed->id,
            'user_id'=> '3', //$enterprise->id,
            'name'=>'More on Seeded Product',
            'description'=>$faker->text(90),
            'price'=>$faker->randomNumber(2),
            'stock'=>100,
            'brand'=>$faker->randomElement(['Apple', 'Gigabyte', 'Microsoft', 'Google. Inc', 'Samsung', 'Lg']),
            'features'=>json_encode([
                    "images"=>[
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg'
                    ],
                    "weight"=>$faker->numberBetween(10, 150).' '.$faker->randomElement(["Mg", "Gr", "Kg", "Oz", "Lb"]),
                    "dimensions"=>$faker->numberBetween(1, 30).' X '.
                                  $faker->numberBetween(1, 30).' X '.
                                  $faker->numberBetween(1, 30).' '.
                                  $faker->randomElement(["inch", "mm", "cm"]),
                    "color"=>$faker->safeColorName
                    ]),
            'condition'=>$faker->randomElement(['new', 'refurbished', 'used']),
            //'currency'=>0,
            'low_stock'=>$faker->randomElement([5, 10, 15]),
            'rate_val'=>'4',
            'rate_count'=>'5',
            'tags' => $faker->word.','.$faker->word.','.$faker->word
        ]);

        //Creates closed orders for rates and mails
        for ($j=0; $j < 5; $j++) {
            Order::create([
                'user_id'=>$user->id,
                'seller_id' => '3',
                'address_id'=>$userAddress->id,
                'status'=>'closed',
                'type'=>'order',
                'description'=>'',
                'seller_id'=>$enterprise->id,
                'end_date'=>$faker->dateTime(),
                'details'=>[
                    [
                        'product_id'=>$seededProduct->id,
                        'price'=>$seededProduct->price,
                        'quantity'=>'1',
                        'delivery_date'=>$faker->dateTime(),
                    ],
                    [
                        'product_id'=>$seededProduct2->id,
                        'price'=>$seededProduct2->price,
                        'quantity'=>'1',
                        'delivery_date'=>$faker->dateTime(),
                    ],
                    [
                        'product_id'=>$seededProduct3->id,
                        'price'=>$seededProduct3->price,
                        'quantity'=>'1',
                        'delivery_date'=>$faker->dateTime(),
                    ],
                ]
            ]);
        }

        //Create an open order to test notices
        Order::create([
            'user_id'=>$user->id,
            'seller_id' => '3',
            'status'=>'open',
            'type'=>'order',
            'description'=>'',
            'seller_id'=>$enterprise->id,
            'address_id'=>$userAddress->id,
            'details'=>[
                [
                    'product_id'=>$seededProduct->id,
                    'price'=>$seededProduct->price,
                    'quantity'=>'3',
                ]
            ]
        ]);
    }
}
