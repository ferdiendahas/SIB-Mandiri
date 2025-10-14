<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
    [
        'id' => 1,
        'genre' => 'Fiksi',
        'description' => 'Kisah imajinatif yang dibuat berdasarkan kreativitas penulis.'
    ],
    [
        'id' => 2,
        'genre' => 'Non-Fiksi',
        'description' => 'Tulisan berdasarkan fakta dan kejadian nyata.'
    ],
    [
        'id' => 3,
        'genre' => 'Romansa',
        'description' => 'Cerita yang berfokus pada hubungan dan perasaan cinta antar tokoh.'
    ],
    [
        'id' => 4,
        'genre' => 'Petualangan',
        'description' => 'Kisah penuh aksi dan perjalanan seru tokoh utama dalam menghadapi tantangan.'
    ],
    [
        'id' => 5,
        'genre' => 'Horor',
        'description' => 'Cerita yang bertujuan menimbulkan rasa takut dan tegang pada pembaca.'
    ],
];

    public function getGenres(){
        return $this->genres;
    }

}
