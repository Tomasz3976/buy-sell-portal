<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Auction;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'username' => 'johndoe',
                'password' => bcrypt('password123'),
                'email' => 'johndoe@example.com',
                'phoneNumber' => '123456789',
            ],
            [
                'firstName' => 'Jane',
                'lastName' => 'Smith',
                'username' => 'janesmith',
                'password' => bcrypt('password123'),
                'email' => 'janesmith@example.com',
                'phoneNumber' => '987654321',
            ],
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
            'name' => 'Canon EOS Rebel T7i',
            'condition' => 'new',
            'category' => 'Electronics',
            'price' => 1500,
            'endDate' => '2023-07-10 18:00:00',
            'photo' => 'canonEOS.jpg'
        ]);
    }
}
