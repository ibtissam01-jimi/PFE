<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name'=>'admin',
            'username'=>'admin123',
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$h3vk6S/R.BCtoe7EfTNE5eXKzioDWzSk3DQlOr7VXknxgLuhTb1Hl',
            'role'=>'admin',
            'nationality'=>'moroccan',
            'birth_date'=>'2025-04-05'
        ]);

        
        DB::table('users')->insert([
            'name'=>'ameur',
            'username'=>'ameur',
            'email'=>'ameurelmoukh@gmail.com',
            'password'=>'$2y$10$h3vk6S/R.BCtoe7EfTNE5eXKzioDWzSk3DQlOr7VXknxgLuhTb1He',
            'role'=>'user',
            'nationality'=>'moroccan',
            'birth_date'=>'2025-04-05'
        ]);

        DB::table('users')->insert([
            'name'=>'saad',
            'username'=>'saad',
            'email'=>'saad@gmail.com',
            'password'=>'$2y$10$h3vk6S/R.BCtoe7EfTNE5eXKzioDWzSk3DQlOr7VXknxgLuhTb1He',
            'role'=>'user',
            'nationality'=>'moroccan',
            'birth_date'=>'2025-04-05'
        ]);
    }
}
