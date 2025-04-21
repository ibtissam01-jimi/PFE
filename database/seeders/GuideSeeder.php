<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tourist__guides')->insert([
            'name' => 'mohammed elyaakoubi',
            'description' => 'Hello,my name is mohammed , I am a touristique guide in my home city which is tanger',
            'cin' => 'AB867564',
            'username' => 'mohammedtanger',
            'address' => 'tanger ahlan',
            'email' => 'mohammedtanger@gmail.com',
            'phone_number' => '+212666666666',
            'city_id' => '1',
            'photo' => '/images/guides/guide1.jpeg',
        ]);

        DB::table('tourist__guides')->insert([
            'name' => 'youssef elkhadiri',
            'description' => 'Hello,my name is youssef , I am a touristique guide in my home city which is Marakkech',
            'cin' => 'MK746354',
            'username' => 'youssefmarakech',
            'address' => 'marakkech gueliz',
            'email' => 'mohammedxyz@gmail.com',
            'phone_number' => '+21266458756',
            'city_id' => '2',
            'photo' => '/images/guides/guide3.jpeg',
        ]);

        DB::table('tourist__guides')->insert([
            'name' => 'mohammed elyaakoubi',
            'description' => 'Hello,my name is mohammed , I am a touristique guide in my home city which is fez',
            'cin' => 'AB867588',
            'username' => 'yassine234',
            'address' => 'fez mon fleuri 2',
            'email' => 'yassine7498374@gmail.com',
            'phone_number' => '+212661458563',
            'city_id' => '3',
            'photo' => '/images/guides/guide1.jpeg',
        ]);

        DB::table('tourist__guides')->insert([
            'name' => 'abd el ilah',
            'description' => 'Hello,my name is abdo , I am a touristique guide in my home city which is rabat',
            'cin' => 'AE867564',
            'username' => 'abdorabat',
            'address' => 'rabat medina',
            'email' => 'mhguthkldh3444r@gmail.com',
            'phone_number' => '+212767566666',
            'city_id' => '4',
            'photo' => '/images/guides/guide2.jpeg',
        ]);

        DB::table('tourist__guides')->insert([
            'name' => 'houcine almou',
            'description' => 'Hello,my name is houcine , I am a touristique guide in my home city which is agadir',
            'cin' => 'AG764839',
            'username' => 'houcinealmou',
            'address' => 'agadir taghazout',
            'email' => 'houcine20002025@gmail.com',
            'phone_number' => '+212758932148',
            'city_id' => '5',
            'photo' => '/images/guides/guide3.jpeg',
        ]);
    }
}
