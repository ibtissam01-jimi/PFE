<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            'name' => 'Hyatt Regency',
            'slug' => 'Hyatshjsj',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites, un spa et hammam, un centre de fitness et une piscine extérieure, ainsi que cinq restaurants',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'submission_id' => 1,
            'phone_number' => '+212625457896',
            'city_id' => 5,
            'category_id' => 4,
            'image' => '/images/cities/m1.jpg'
        ]);


        DB::table('services')->insert([
            'name' => 'Hyatt Regency',
            'slug' => 'Hyasj',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites, un spa et hammam, un centre de fitness et une piscine extérieure, ainsi que cinq restaurants',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'submission_id' => 1,
            'phone_number' => '+212625457896',
            'city_id' => 5,
            'category_id' => 2,
            'image' => '/images/cities/sahara.jpeg'
        ]);



        
        DB::table('services')->insert([
            'name' => 'Hyatt Regency',
            'slug' => 'jsi',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites, un spa et hammam, un centre de fitness et une piscine extérieure, ainsi que cinq restaurants',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'submission_id' => 1,
            'phone_number' => '+212625457896',
            'city_id' => 5,
            'category_id' => 1,
            'image' => '/images/cities/m2.jpg'
        ]);


        DB::table('services')->insert([
            'name' => 'Hyatt Regency',
            'slug' => 'jdjdj',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites, un spa et hammam, un centre de fitness et une piscine extérieure, ainsi que cinq restaurants',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'submission_id' => 1,
            'phone_number' => '+212625457896',
            'city_id' => 5,
            'category_id' => 4,
            'image' => '/images/cities/m2.jpg'
        ]);




        DB::table('services')->insert([
            'name' => 'Hyatt Regency',
            'slug' => 'jsnskl',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites, un spa et hammam, un centre de fitness et une piscine extérieure, ainsi que cinq restaurants',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'submission_id' => 1,
            'phone_number' => '+212625457896',
            'city_id' => 5,
            'category_id' => 3,
            'image' => '/images/cities/m2.jpg'
        ]);




        DB::table('services')->insert([
            'name' => 'Hyatt Regency',
            'slug' => 'jsijsi',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites, un spa et hammam, un centre de fitness et une piscine extérieure, ainsi que cinq restaurants',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'submission_id' => 1,
            'phone_number' => '+212625457896',
            'city_id' => 5,
            'category_id' => 4,
            'image' => '/images/cities/m2.jpg'
        ]);




        DB::table('services')->insert([
            'name' => 'Hyatt Regency',
            'slug' => 'jsiddkk',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites, un spa et hammam, un centre de fitness et une piscine extérieure, ainsi que cinq restaurants',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'submission_id' => 1,
            'phone_number' => '+212625457896',
            'city_id' => 5,
            'category_id' => 3,
            'image' => '/images/cities/m2.jpg'
        ]);




        DB::table('services')->insert([
            'name' => 'Hyatt Regency',
            'slug' => 'jshdiki',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites, un spa et hammam, un centre de fitness et une piscine extérieure, ainsi que cinq restaurants',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'submission_id' => 1,
            'phone_number' => '+212625457896',
            'city_id' => 5,
            'category_id' => 4,
            'image' => '/images/cities/m2.jpg'
        ]);
    }
}
