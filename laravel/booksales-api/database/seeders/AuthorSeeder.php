<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Andrea Hirata',
            'photo' => 'andrea.jpg',
            'bio' => 'Penulis novel Laskar Pelangi yang menginspirasi banyak orang.'
        ]);

        Author::create([
            'name' => 'Dewi Lestari',
            'photo' => 'dee.jpg',
            'bio' => 'Penulis Filosofi Kopi yang terkenal dengan gaya bahasa puitis.'
        ]);

        Author::create([
            'name' => 'Tere Liye',
            'photo' => 'tere.jpg',
            'bio' => 'Penulis novel tentang kehidupan, cinta, dan perjuangan.'
        ]);

        Author::create([
            'name' => 'Habiburrahman El Shirazy',
            'photo' => 'habib.jpg',
            'bio' => 'Dikenal dengan novel Ayat-Ayat Cinta dan Ketika Cinta Bertasbih.'
        ]);

        Author::create([
            'name' => 'Raditya Dika',
            'photo' => 'radit.jpg',
            'bio' => 'Penulis dan komedian dengan gaya humor khas Indonesia.'
        ]);
    }
}
