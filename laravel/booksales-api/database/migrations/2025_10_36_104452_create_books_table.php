<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255); 
            $table->text('description')->nullable(); 
            $table->decimal('price', 10, 2); 
            $table->integer('stock')->default(0); 
            $table->string('cover_photo', 255)->nullable(); 
            $table->unsignedBigInteger('genre_id'); 
            $table->unsignedBigInteger('author_id');
            $table->timestamps();

            // //foreign keys
            // $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            // $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
