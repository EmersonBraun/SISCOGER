<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
            'rg' => '103804957',
            'email'=>'emersonfbraun@gmail.com',
            'password' => bcrypt('515359'),
        ]);
       
    }
}
