<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            [
                'name' => 'Khoa học máy tính Nhiệm vụ chiến lược',
            ],
            [
                'name' => 'Khoa học máy tính Chất lượng cao',
            ],
            [
                'name' => 'Khoa học máy tính',
            ],
            [
                'name' => 'Công nghệ kỹ thuật điện tử, truyền thông Nhiệm vụ chiến lược',
            ],
            [
                'name' => 'Công nghệ kỹ thuật điện tử, truyền thông Chất lượng cao',
            ],
            [
                'name' => 'Công nghệ kỹ thuật điện tử, truyền thông',
            ],
            [
                'name' => 'Công nghệ thông tin Chất lượng cao',
            ],
            [
                'name' => 'Công nghệ thông tin',
            ],
            [
                'name' => 'Hệ thống thông tin',
            ],
            [
                'name' => 'Truyền thông và mạng máy tính',
            ],
            [
                'name' => 'Vật lý kỹ thuật',
            ],
            [
                'name' => 'Kỹ thuật năng lượng',
            ],
            [
                'name' => 'Cơ kỹ thuật',
            ],
            [
                'name' => 'Công nghệ kỹ thuật cơ điện tử',
            ],
        ]);
    }
}
