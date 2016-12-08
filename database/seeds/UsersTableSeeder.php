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
        DB::table('users')->insert([
            [
                'username' => 'superadmin',
                'email' => '',
                'password' => bcrypt('12345'),
                'role' => '0', // superadmin
            ],
            [
                'username' => 'fitadmin',
                'email' => '',
                'password' => bcrypt('12345'),
                'role' => '1', //admin
            ],
            [
                'username' => 'fetadmin',
                'email' => '',
                'password' => bcrypt('12345'),
                'role' => '1', //admin
            ],
            [
                'username' => 'Nguyen Van A',
                'email' => '1@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' =>'3'
            ],
              [
                'username' => 'Nguyen Van B',
                'email' => '2@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' =>'3'
            ],
              [
                'username' => 'Nguyen Van C',
                'email' => '3@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' =>'3'
            ],
              [
                'username' => 'Nguyen Van D',
                'email' => '4@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' =>'3'
            ],[
                'username' => 'Lê Văn A',
                'email'  => '10@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' => '2'
            ],[
                'username' => 'Bùi Văn H',
                'email' => '11@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' => '2'
            ]
        ]);
    }
}
