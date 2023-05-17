<?php

namespace Database\Seeders;

use App\Models\RoomsAndCottages;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'first_name' => 'Admin',
            'email' => 'admin@labaksamorong.com',
            'password' => Hash::make('admin'),
            'user_role' => 1
        ]);

        User::create([
            'first_name' => 'Christine',
            'last_name' => 'Manabat',
            'email' => 'test@gmail.com',
            'birthday' => '25-12-99',
            'email_verified_at' => 'test@gmail.com',
            'password' => Hash::make('user'),
            'user_role' => 2
        ]);

        RoomsAndCottages::create([
            'room_id' => 'Room 101',
            'room_name' => '2-Bed Ventilated Room',
            'cottage_name' => NULL,
            'room_cottage_price' => '800',
            'room_cottage_image' => 'Room 101-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => 'Room 102',
            'room_name' => '2-Bed Airconditioned Room',
            'cottage_name' => NULL,
            'room_cottage_price' => '2000',
            'room_cottage_image' => 'Room 102-2.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => 'Room 103',
            'room_name' => '1-Bed Ventilated Room',
            'cottage_name' => NULL,
            'room_cottage_price' => '2000',
            'room_cottage_image' => 'Room 103-3.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Anahaw',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Anahaw-8.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Sampaguita',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Sampaguita-8.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Narra',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Narra-5.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Acacia',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Acacia-3.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Langka',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Langka-3.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Carnation',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Carnation-6.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Cadena de Amor',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Cadena de Amor-7.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Dama de Noche',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Dama de Noche-4.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Lily',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Lily-4.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Gladiola',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Gladiola-4.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Daisy',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Daisy-2.png'
        ]);


        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Rosas',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Rosas-2.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Waling-Waling',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Waling-Waling-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Camia',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Camia-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Dahlia',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Dahlia-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Sta Ana',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Sta Ana-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Yellow Bell',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Yellow Bell-1.png'
        ]);
    }
}
