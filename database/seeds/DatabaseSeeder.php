<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Brand;
use App\Category;
use App\Contact;
use App\Product;
use App\User;

class DatabaseSeeder extends Seeder
{
    const DEFAULT_PASSWORD = "p4ssw0rd!";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $totalBrand     = Brand::where("id", "<>", 0)->count();
        $totalCategory  = Category::where("id", "<>", 0)->count();
        $totalContact   = Contact::where("id", "<>", 0)->count();
        $totalProduct   = Product::where("id", "<>", 0)->count();
        $totalUser      = User::where("id", "<>", 0)->count();

        if($totalBrand == 0)
        {
            for($i = 11; $i <= 20; $i++)
            {
                $faker = Faker::create("id_ID");
                Brand::create([
                    "code"=> "B".date("Ymd")."".$i,
                    "name"=> $faker->sentence,
                    "description"=> $faker->text
                ]);
            }
        }

        if($totalCategory == 0)
        {
            for($i = 11; $i <= 20; $i++)
            {
                $faker = Faker::create("id_ID");
                Category::create([
                    "code"=> "C".date("Ymd")."".$i,
                    "name"=> $faker->sentence,
                    "description"=> $faker->text
                ]);
            }
        }

        if($totalContact == 0)
        {
            for($i = 1; $i <= 1000; $i++)
            {
                $faker = Faker::create("id_ID");
                Contact::create([
                    "name"=> $faker->name,
                    "email"=> $faker->email,
                    "website"=> $faker->domainName,
                    "phone"=> $faker->phoneNumber,
                    "address"=> $faker->address,
                ]);
            }
        }

        if($totalProduct == 0)
        {
            for($i = 11; $i <= 50; $i++)
            {
                $brand = Brand::inRandomOrder()->first();
                $product = Product::create([
                    "brand_id"=> $brand->id,
                    "code"=> "P".date("Ymd")."".$i,
                    "stock"=> rand(1, 100),
                    "price"=> rand(100, 999),
                    "name"=> $faker->sentence,
                    "description"=> $faker->text
                ]);

                $categories = Brand::inRandomOrder()->take(3)->get();
                foreach($categories as $category)
                {
                    $product->Categories()->sync([$category->id]);
                }

            }
        }

        if($totalUser == 0)
        {
            for($i = 1; $i <= 100; $i++)
            {
                $faker = Faker::create("id_ID");
                User::create([
                    'name'=> $faker->name,
                    'email'=> $i == 1 ? "admin@example.com" : $faker->safeEmail,
                    'password'=> Hash::make(self::DEFAULT_PASSWORD)
                ]);
            }
        }

    }
}
