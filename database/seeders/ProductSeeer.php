<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as Fake;
use Carbon\Carbon;
class ProductSeeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Fake::create();
        foreach (range(1,20) as $index) {
            DB::table('product_models')->insert([

                'product_name' =>$faker->sentence(10),
                'slug' => $faker->slug,
                'product_specification' => $faker->sentence(50),
                'currency' =>'bt',
                'regular_price' =>900,
                'sale_price' =>750,
                'product_quantity' =>10,
                'product_image' => $faker->image('public/back_end/images/Product_images',800,800),
//                'product_image' => $faker->imageUrl(800,800,'cloth',),
                'long_description' => $faker->realText(350),
                'category_name' =>'Easy brand',
                'category_id' =>3,
                'brand_name' =>'Azmiri',
                'status' => 1,
                'created_at' =>Carbon::now(),
                'updated_at' =>Carbon::now(),
            ]);
        }
    }
}
