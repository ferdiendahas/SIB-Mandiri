<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    private $books = [
        [   
            'title' => 'Pulang',
            'description' => 'Petualangan seorang pemuda yang kembali ke desa kelahirannya.',
            'price' => 40000,
            'stock' => 15,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1,
            'author_id' => 1,
        ],
        [
        'title' => 'Laskar Pelangi',
        'description' => 'Kisah inspiratif anak-anak di Belitung yang berjuang demi pendidikan.',
        'price' => 55000,
        'stock' => 20,
        'cover_photo' => 'laskar_pelangi.jpg',
        'genre_id' => 2,
        'author_id' => 2,
        ],
        [
        'title' => 'Negeri 5 Menara',
        'description' => 'Perjalanan enam santri dengan impian besar di pondok pesantren.',
        'price' => 50000,
        'stock' => 10,
        'cover_photo' => 'negeri5menara.jpg',
        'genre_id' => 3,
        'author_id' => 3,
        ],
    ];
    
    public function getBooks(){
        return $this->books;
    }

    protected $table = 'books';
}
