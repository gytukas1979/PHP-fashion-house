<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $faker = \Faker\Factory::create();
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Gytis',
            'email' => 'gytisviskacka@yahoo.com',
            'password' => Hash::make('12345'),
        ]);

        foreach(range(1, 15) as $value) {
            DB::table('masters')->insert([
                'name' => ucfirst(strtolower($faker->firstname)),
                'surname' => ucfirst(strtolower($faker->lastname)),
            ]);
        }

        $outfitsList = ['Sweater', 'Shirt', 'Jeans', 'Gloves', 'Cap', 'Suit', 'Shorts', 'Jacket', 'Jumper', 'Blazer'];
        $colorList = ['White', 'Black', 'Yellow', 'Green', 'Red', 'Blue', 'Orange', 'Brown', 'Grey', 'Purple'] ;
        foreach(range(1, 100) as $value) {
            DB::table('outfits')->insert([
                'type' => $outfitsList[rand(0,9)],
                'color' => $colorList[rand(0,9)],
                'size' => rand(1, 199),
                'master_id' => rand(1,15),
            ]);
        }
    }
}
