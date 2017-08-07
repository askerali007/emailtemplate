<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->truncate();
        DB::table('users')->insert([
        	[
        		'name' => 'Aslam',
        		'email' => 'asker2@techmart.solutions',
        		'password' => bcrypt('123456'),
        		'mobile' => '1234567890'
        	],
        	[
        		'name' => 'Aneesh',
        		'email' => 'aneesh@techmart.solutions',
        		'password' => bcrypt('123456'),
        		'mobile' => '54252523'
        	],
            [
                'name' => 'Sagar',
                'email' => 'sagar@techmart.solutions',
                'password' => bcrypt('123456'),
                'mobile' => '54252523'
            ],
            [
                'name' => 'Sneha',
                'email' => 'sneha@techmart.solutions',
                'password' => bcrypt('123456'),
                'mobile' => '54252523'
            ],
            [
                'name' => 'Hayat',
                'email' => 'hayat@techmart.solutions',
                'password' => bcrypt('123456'),
                'mobile' => '54252523'
            ],
            [
                'name' => 'Tanveer',
                'email' => 'tanveer@techmart.solutions',
                'password' => bcrypt('123456'),
                'mobile' => '54252523'
            ],
            [
                'name' => 'Anil',
                'email' => 'anil@techmart.solutions',
                'password' => bcrypt('123456'),
                'mobile' => '54252523'
            ],
            [
                'name' => 'Shameem',
                'email' => 'shameem06@gmail.com',
                'password' => bcrypt('123456'),
                'mobile' => '54252523'
            ],
            [
                'name' => 'Smith',
                'email' => 'smith@techmart.solutions',
                'password' => bcrypt('123456'),
                'mobile' => '54252523'
            ],
            [
                'name' => 'John',
                'email' => 'john@techmart.solutions',
                'password' => bcrypt('123456'),
                'mobile' => '54252523'
            ],

        	]);
    }
}
