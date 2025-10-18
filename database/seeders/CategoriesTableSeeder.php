<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categories = [
            ['name' => 'Fiction', 'description' => 'Novels and stories created from imagination.'],
            ['name' => 'Non-fiction', 'description' => 'Books based on facts, real events, and real people.'],
            ['name' => 'Science', 'description' => 'Books about scientific concepts and discoveries.'],
            ['name' => 'Biography', 'description' => 'Life stories of notable people.'],
            ['name' => 'Children', 'description' => 'Books suitable for young readers.'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert(array_merge($category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
