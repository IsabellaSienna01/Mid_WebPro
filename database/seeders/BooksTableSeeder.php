<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $books = [
            [
                'title' => "Harry Potter and the Sorcerer's Stone",
                'author' => 'J.K. Rowling',
                'publisher' => 'Bloomsbury',
                'year' => 1997,
                'stock' => 10,
                'category_id' => 5, // Children
                'description' => 'A fantasy story for young readers about the magical world of Harry Potter.',
                'image' => 'harrypotter.jpg',
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'publisher' => 'Scribner',
                'year' => 1925,
                'stock' => 5,
                'category_id' => 1,
                'description' => 'Classic novel depicting life in 1920s America.',
                'image' => 'greatgatsby.webp',
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'Harper',
                'year' => 2011,
                'stock' => 8,
                'category_id' => 2, 
                'description' => 'History of humankind from ancient to modern times.',
                'image' => 'sapiens.jpg',
            ],
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'publisher' => 'Bantam Books',
                'year' => 1988,
                'stock' => 6,
                'category_id' => 3, 
                'description' => 'Explains the fundamental concepts of cosmology for general readers.',
                'image' => 'abriefhistorytime.jpg',
            ],
            [
                'title' => 'The Diary of a Young Girl',
                'author' => 'Anne Frank',
                'publisher' => 'Contact Publishing',
                'year' => 1947,
                'stock' => 4,
                'category_id' => 4,
                'description' => 'The diary of Anne Frank during the Holocaust.',
                'image' => 'thediaryofayounggirl.jpg',
            ],
        ];

        foreach ($books as $book) {
            DB::table('books')->insert(array_merge($book, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
