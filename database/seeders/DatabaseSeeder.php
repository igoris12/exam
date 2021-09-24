<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('it_IT');
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $Statuses = ['Done','In progress', 'OK', 'Unfinished', 'Postponed', 'Important'];
        foreach(range(0, count($Statuses)-1) as $i) {
            $type = $Statuses[rand(0, count($Statuses) - 1)];
            DB::table('Statuses')->insert([
                'name' =>  $Statuses[$i],
            ]);
        }
        
        
        
        $horsesCount = 20;
        foreach(range(1, $horsesCount) as $_) {
            $todayDate = date("Y-m-d H:i:s");

            DB::table('Tasks')->insert([
                'task_name' => $faker->text($maxNbChars = 30),
                'task_description' =>  $faker->text($maxNbChars = 200),
                'completed_data' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
                'status_id' =>  rand(1, count($Statuses)),
            ]);
        }

    }
}
