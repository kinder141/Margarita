<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Redis;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)
            ->create([
                'id'=>1,
                'email' => 'test@test.com'
            ])->each(function ($u) {
                Redis::set($u->id, 'laptops');
                Redis::set($u->id .':laptops', 'data');
            });

         factory(App\User::class)
             ->create([
                 'id'=>2,
                 'email' => 'test2@test.com'
             ])->each(function ($u) {
                 Redis::set($u->id, 'laptops');
                 Redis::set($u->id . ':laptops', 'data');
             });
    }
}
