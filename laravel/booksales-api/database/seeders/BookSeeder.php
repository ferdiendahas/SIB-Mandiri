<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Laskar Pelangi',
            'description' => 'Kisah inspiratif anak-anak Belitung dalam mengejar mimpi.',
            'price' => 85000,
            'stock' => 20,
            'cover_photo' => 'laskar.jpg',
            'genre_id' => 1,
            'author_id' => 1,
        ]);

        Book::create([
            'title' => 'Filosofi Kopi',
            'description' => 'Kumpulan cerita penuh makna kehidupan dari secangkir kopi.',
            'price' => 70000,
            'stock' => 15,
            'cover_photo' => 'kopi.jpg',
            'genre_id' => 2,
            'author_id' => 2,
        ]);

        Book::create([
            'title' => 'Rindu',
            'description' => 'Kisah perjalanan spiritual dan cinta dalam ibadah haji.',
            'price' => 90000,
            'stock' => 10,
            'cover_photo' => 'rindu.jpg',
            'genre_id' => 3,
            'author_id' => 3,
        ]);

        Book::create([
            'title' => 'Ayat-Ayat Cinta',
            'description' => 'Kisah romantis dan religius berlatar Kairo.',
            'price' => 95000,
            'stock' => 25,
            'cover_photo' => 'ayat.jpg',
            'genre_id' => 2,
            'author_id' => 4,
        ]);

        Book::create([
            'title' => 'Kambing Jantan',
            'description' => 'Kisah kocak mahasiswa Indonesia di luar negeri.',
            'price' => 60000,
            'stock' => 30,
            'cover_photo' => 'kambing.jpg',
            'genre_id' => 3,
            'author_id' => 5,
        ]);
    }
}
