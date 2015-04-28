<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Maker;
use App\User;
use Faker\Factory as Faker;

class UsersSeed extends Seeder {
        
    public function run()
    {
//        $faker = User::create();
//
//        for($i = 0; $i < 6; $i++)
//        {                
            User::create
            ([
//                'email' => $faker->word(),
//                'password' => $faker->randomDigit(5)
                'email' => 'fake@fake.com',
                'password' => Hash::make('pass')
            ]);
//
//        }
    }

}
