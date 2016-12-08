<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		 DB::table('students')->insert([
            [
            	'id' => '1',
                'name' => 'Nguyen Van A',
                'class' => 'K59CB',
                'training_program' => 'CNTT',
                'status' => '1',
                'status_register'=>'0',
                'user_id' => '5',
            ],
            [
            	'id' => '2',
               'name' => 'Nguyen Van B',
                'class' => 'K59CB',
                'training_program' => 'CNTT',
                'status' => '1',
                'status_register'=>'0',
                'user_id' => '6',
            ],
            [
            	'id' => '3',
                'name' => 'Nguyen Van C',
                'class' => 'K59CB',
                'training_program' => 'CNTT',
                'status' => '0',
                'status_register' => '0',
                'user_id' => '7',
            ],
            [
            	'id' => '4',
                'name' => 'Nguyen Van D',
                'class' => 'K59CB',
                'training_program' => 'CNTT',
                'status' => '0',
                'status_register' =>'0',
                'user_id' => '8',
            ],
            
        ]);
    }
}
