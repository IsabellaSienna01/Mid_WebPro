<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'book_id' => 1,
                'member_id' => 1,
                'rating' => 5,
                'review_text' => 'Excellent book, very engaging!',
            ],
            [
                'book_id' => 2,
                'member_id' => 2,
                'rating' => 4,
                'review_text' => 'Interesting read, but a bit long.',
            ],
            [
                'book_id' => 3,
                'member_id' => 3,
                'rating' => 5,
                'review_text' => 'A must-read for everyone!',
            ],
            [
                'book_id' => 4,
                'member_id' => 1,
                'rating' => 3,
                'review_text' => 'Good book but not my favorite.',
            ],
            [
                'book_id' => 5,
                'member_id' => 2,
                'rating' => 4,
                'review_text' => 'Well-written and informative.',
            ],
        ];

        foreach ($reviews as $review) {
            DB::table('book_reviews')->insert(array_merge($review, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
