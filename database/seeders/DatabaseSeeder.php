<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LoginsTableSeeder::class,
            MembersTableSeeder::class,
            CategoriesTableSeeder::class,
            BooksTableSeeder::class,
            BookRequestTableSeeder::class,
            BookReviewTableSeeder::class,
            LoansTableSeeder::class,
            LoanDetailsTableSeeder::class,
            FinesTableSeeder::class,
        ]);
    }
}
