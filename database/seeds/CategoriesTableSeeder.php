<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Redis;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category = factory(App\Category::class)
            ->create([
                'name' => 'Laptops'
            ]);

        for ($i = 0; $i < 50; $i++) {
            $laptop = factory(App\Laptop::class)->make();
            $category->laptops()->save($laptop);
            factory(App\MongoProduct::class)->make([
                'product_id' => $laptop->id,
                'category_id' => $category->id
            ])->save();
        }

        $category =  factory(App\Category::class)
            ->create([
                'name' => 'Smartphones'
            ]);

        for ($i = 0; $i < 50; $i++) {
            $smartphone = factory(App\Smartphone::class)->make();
            $category->smartphones()->save($smartphone);
            factory(App\MongoProduct::class)->make([
                'product_id' => $smartphone->id,
                'category_id' => $category->id
            ])->save();
        }

        $category = factory(App\Category::class)
            ->create([
                'name' => 'Televisions'
            ]);

        for ($i = 0; $i < 50; $i++) {
            $tv = factory(App\Television::class)->make();
            $category->televisions()->save($tv);
            factory(App\MongoProduct::class)->make([
                'product_id' => $tv->id,
                'category_id' => $category->id
            ])->save();
        }
    }
}
