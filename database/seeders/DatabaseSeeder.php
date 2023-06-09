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
            'email' => 'tine@gmail.com',
            'birthday' => '1999-12-25',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'user_role' => 2
        ]);

        RoomsAndCottages::create([
            'room_id' => 'Room 101',
            'room_name' => '2-Bed Ventilated Room',
            'cottage_name' => NULL,
            'place_room_cottage' => 'Taas',
            'room_cottage_price' => '800',
            'room_cottage_image' => 'Room 101-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => 'Room 102',
            'room_name' => '2-Bed Airconditioned Room',
            'cottage_name' => NULL,
            'place_room_cottage' => 'Taas',
            'room_cottage_price' => '2000',
            'room_cottage_image' => 'Room 102-2.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => 'Room 103',
            'room_name' => '1-Bed Ventilated Room',
            'cottage_name' => NULL,
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '2000',
            'room_cottage_image' => 'Room 103-3.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Anahaw',
            'place_room_cottage' => 'Taas',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Anahaw-8.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Sampaguita',
            'place_room_cottage' => 'Taas',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Sampaguita-8.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Narra',
            'place_room_cottage' => 'Taas',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Narra-5.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Acacia',
            'place_room_cottage' => 'Taas',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Acacia-3.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Langka',
            'place_room_cottage' => 'Taas',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Langka-3.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Carnation',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Carnation-6.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Cadena de Amor',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '500',
            'room_cottage_image' => 'Cadena de Amor-7.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Dama de Noche',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Dama de Noche-4.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Lily',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Lily-4.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Gladiola',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '450',
            'room_cottage_image' => 'Gladiola-4.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Daisy',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Daisy-2.png'
        ]);


        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Rosas',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Rosas-2.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Waling-Waling',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Waling-Waling-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Camia',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Camia-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Dahlia',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Dahlia-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Sta Ana',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Sta Ana-1.png'
        ]);

        RoomsAndCottages::create([
            'room_id' => NULL,
            'room_name' => NULL,
            'cottage_name' => 'Yellow Bell',
            'place_room_cottage' => 'Baba',
            'room_cottage_price' => '400',
            'room_cottage_image' => 'Yellow Bell-1.png'
        ]);
    }
}
