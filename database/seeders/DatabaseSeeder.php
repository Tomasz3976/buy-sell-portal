<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Auction;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tworzenie użytkowników
        $users = [
            [
                'firstName' => 'John',
                'lastName' => 'Doe',
                'username' => 'johndoe34',
                'password' => bcrypt('Password123#'),
                'email' => 'johndoe34@outlook.com',
                'phoneNumber' => '123456789',
            ],
            [
                'firstName' => 'Jane',
                'lastName' => 'Smith',
                'username' => 'janesmith129',
                'password' => bcrypt('myAmazingPassword#55'),
                'email' => 'janesmith555@outlook.com',
                'phoneNumber' => '987654321',
            ],
            [
                'firstName' => 'William',
                'lastName' => 'Simon',
                'username' => 'willyWonka88',
                'password' => bcrypt('littleLeaf44@@'),
                'email' => 'williamSimon@gmail.com',
                'phoneNumber' => '574022186',
            ],
            [
                'firstName' => 'Amanda',
                'lastName' => 'Nunez',
                'username' => 'amandaNunn774',
                'password' => bcrypt('MyFavouritePlaceIsLondon993!!'),
                'email' => 'amandaNunez.567@outlook.com',
                'phoneNumber' => '679300126',
            ],
            [
                'firstName' => 'Admin',
                'lastName' => 'Admin',
                'username' => 'AdminAdmin',
                'password' => bcrypt('1234ABCD6789GHIJ'),
                'email' => 'adminadmin.789@outlook.com',
                'phoneNumber' => '198756432',
                'role' => 1
            ]
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
        }

        $users = User::all();

        $users[0]->auctions()->create([
            'name' => 'iPhone X',
            'condition' => 'used',
            'category' => 'Electronics',
            'price' => 1000,
            'endDate' => '2023-06-30 20:00:00',
            'photo' => 'iphoneX.jpg'
        ]);

        $users[1]->auctions()->create([
            'name' => 'iPhone 12',
            'condition' => 'new',
            'category' => 'Electronics',
            'price' => 1200,
            'endDate' => '2023-06-30 20:00:00',
            'photo' => 'iphone12.jpg'
        ]);

        $users[2]->auctions()->create([
            'name' => 'Canon EOS Rebel T7i',
            'condition' => 'new',
            'category' => 'Electronics',
            'price' => 1500,
            'endDate' => '2023-06-20 20:00:00',
            'photo' => 'canonEOS.jpg'
        ]);

        $users[2]->auctions()->create([
            'name' => 'Designer Dress',
            'condition' => 'new',
            'category' => 'Fashion',
            'price' => 150,
            'endDate' => '2023-06-30 20:00:00',
            'photo' => 'designerDress.jpg'
        ]);

        $users[3]->auctions()->create([
            'name' => 'Garden Tools Set',
            'condition' => 'new',
            'category' => 'Garden',
            'price' => 250,
            'endDate' => '2023-06-30 20:00:00',
            'photo' => 'gardenToolsSet.jpg'
        ]);

        $users[3]->auctions()->create([
            'name' => 'MacBook Pro',
            'condition' => 'used',
            'category' => 'Electronics',
            'price' => 2000,
            'endDate' => '2023-06-30 20:00:00',
            'photo' => 'macBookPro.jpg'
        ]);
    }
}
