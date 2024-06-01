<?php

namespace Database\Seeders;

use App\Models\RestoList;
use App\Models\User;
use App\Models\Review;
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

        // User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@sneakybites.com',
            'password' => Hash::make('aaaaa'),
            'address' => 'Jalan Kebon Kacang No. 40',
            'phone_number' => 123456789,
            'is_admin' => 1
        ]);

        User::create([
            'name' => 'Resto',
            'email' => 'resto@sneakybites.com',
            'password' => Hash::make('aaaaa'),
            'address' => 'Jalan Kebon Kacang No. 40',
            'phone_number' => 123456789,
            'is_resto' => 1
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@sneakybites.com',
            'password' => Hash::make('aaaaa'),
            'address' => 'Jalan Kebon Kacang No. 40',
            'phone_number' => 123456789,
            'is_admin' => 0
        ]);

        // Travel List

        RestoList::create([
            'image' => 'Plate-Palate.webp',
            'menu' => 'Plate-Palate.webp',
            'title' => 'Plate Palate, Jakarta ',
            'maps' => 'Plate Palate, Jakarta ',
            'description' => 'Plate Palate adalah restoran hidden gem di Jakarta yang menyajikan aneka masakan, mulai dari indonesian food, western, hingga chinese food. Restoran yang punya vibes rumahan ini terletak di dalam ujung gang tepat diujung gang, sehingga tempatnya tidak terlalu luas. Tapi, ambience di sini sangat tenang karena jauh dari bising kendaraan. Selain makanan berat, Plate Palate juga menyediakan coffee dan cemilan. Cocok untuk kamu yang ingin sekalian WFC, nih.',
            'alamat' => 'Jalan Kemang Timur III A No. 2C, RT.7/RW.4, Kec. Mampang Prapatan, Jakarta Selatan',
            'range' => 'Rp 25.000 – Rp 60.000',
            'total_rating' => 4
        ]);
        RestoList::create([
            'image' => 'Plate-Palate.webp',
            'menu' => 'Plate-Palate.webp',
            'title' => 'Plate Palate, Jakarta ',
            'maps' => 'Plate Palate, Jakarta ',
            'description' => 'Plate Palate adalah restoran hidden gem di Jakarta yang menyajikan aneka masakan, mulai dari indonesian food, western, hingga chinese food. Restoran yang punya vibes rumahan ini terletak di dalam ujung gang tepat diujung gang, sehingga tempatnya tidak terlalu luas. Tapi, ambience di sini sangat tenang karena jauh dari bising kendaraan. Selain makanan berat, Plate Palate juga menyediakan coffee dan cemilan. Cocok untuk kamu yang ingin sekalian WFC, nih.',
            'alamat' => 'Jalan Kemang Timur III A No. 2C, RT.7/RW.4, Kec. Mampang Prapatan, Jakarta Selatan',
            'range' => 'Rp 25.000 – Rp 60.000',
            'total_rating' => 5
        ]);
        RestoList::create([
            'image' => 'Plate-Palate.webp',
            'menu' => 'Plate-Palate.webp',
            'title' => 'Plate Palate, Jakarta ',
            'maps' => 'Plate Palate, Jakarta ',
            'description' => 'Plate Palate adalah restoran hidden gem di Jakarta yang menyajikan aneka masakan, mulai dari indonesian food, western, hingga chinese food. Restoran yang punya vibes rumahan ini terletak di dalam ujung gang tepat diujung gang, sehingga tempatnya tidak terlalu luas. Tapi, ambience di sini sangat tenang karena jauh dari bising kendaraan. Selain makanan berat, Plate Palate juga menyediakan coffee dan cemilan. Cocok untuk kamu yang ingin sekalian WFC, nih.',
            'alamat' => 'Jalan Kemang Timur III A No. 2C, RT.7/RW.4, Kec. Mampang Prapatan, Jakarta Selatan',
            'range' => 'Rp 25.000 – Rp 60.000',
            'total_rating' => 5
        ]);
        RestoList::create([
            'image' => 'Plate-Palate.webp',
            'menu' => 'Plate-Palate.webp',
            'title' => 'Plate Palate, Jakarta ',
            'maps' => 'Plate Palate, Jakarta ',
            'description' => 'Plate Palate adalah restoran hidden gem di Jakarta yang menyajikan aneka masakan, mulai dari indonesian food, western, hingga chinese food. Restoran yang punya vibes rumahan ini terletak di dalam ujung gang tepat diujung gang, sehingga tempatnya tidak terlalu luas. Tapi, ambience di sini sangat tenang karena jauh dari bising kendaraan. Selain makanan berat, Plate Palate juga menyediakan coffee dan cemilan. Cocok untuk kamu yang ingin sekalian WFC, nih.',
            'alamat' => 'Jalan Kemang Timur III A No. 2C, RT.7/RW.4, Kec. Mampang Prapatan, Jakarta Selatan',
            'range' => 'Rp 25.000 – Rp 60.000',
            'total_rating' => 5
        ]);

    }
}



