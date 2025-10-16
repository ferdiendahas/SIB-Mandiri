<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
    [
        'id' => 1,
        'name' => 'Andrea Hirata',
        'photo' => 'andrea_hirata.jpg',
        'bio' => 'Penulis terkenal asal Belitung, dikenal lewat novel Laskar Pelangi yang menginspirasi banyak orang.'
    ],
    [
        'id' => 2,
        'name' => 'Tere Liye',
        'photo' => 'tere_liye.jpg',
        'bio' => 'Penulis produktif asal Indonesia dengan karya populer seperti Hujan, Bumi, dan Rindu.'
    ],
    [
        'id' => 3,
        'name' => 'Dee Lestari',
        'photo' => 'dee_lestari.jpg',
        'bio' => 'Seorang novelis dan musisi Indonesia yang dikenal lewat seri Supernova dan Filosofi Kopi.'
    ],
    [
        'id' => 4,
        'name' => 'Ahmad Fuadi',
        'photo' => 'ahmad_fuadi.jpg',
        'bio' => 'Penulis novel inspiratif Negeri 5 Menara yang diangkat dari pengalaman hidupnya di pesantren.'
    ],
    [
        'id' => 5,
        'name' => 'Raditya Dika',
        'photo' => 'raditya_dika.jpg',
        'bio' => 'Penulis, komedian, dan sutradara Indonesia yang dikenal lewat karya humor seperti Kambing Jantan.'
    ],
];

    public function getAuthors(){
        return $this->authors;
    }

    protected $table = 'authors';
}
