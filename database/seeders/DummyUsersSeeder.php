<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('admin123'),
                'role'=>'admin',
            ],
            [
                'name'=>'Saksi',
                'email'=>'saksi@gmail.com',
                'password'=>bcrypt('saksi123'),
                'role'=>'saksi',
            ],
        ];

        foreach ($userData as $key => $val){
            User::create($val);
        }
    }
}
