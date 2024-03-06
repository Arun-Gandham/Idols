<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Arun Sai Gandham',
            'email' => 'arun@gmail.com',
            'password' => Hash::make('1234567890'),
            'age' => 25, 
            'phone' => '9121855669',
            'is_active' => 1
        ]);

        DB::table('settings')->insert([
            'name' => 'Sri Venkata Naga Vyshnavi Idols',
            'description' => 'Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.',
            'model' => date('Y'),
            'email' => "arunsaigandham1998@gmail.com", 
            'phone' => '9121855669'
        ]);

        DB::table('product_types')->insert([
            'name' => 'Ganapathi',
            'description' => 'Embrace tradition. Timeless clay idols: crafted artistry, cultural elegance.'
        ]);

        DB::table('product_feets')->insert([
            'feet' => 5
        ]);

        DB::table('roles')->insert([
            'name' => 'User'
        ]);
    }
}
