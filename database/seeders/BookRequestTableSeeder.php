<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $requests = [
            [
                'member_id' => 1,
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'publisher' => 'Little, Brown and Company',
                'reason' => 'I want to improve my literature knowledge.',
                'status' => 'pending',
            ],
            [
                'member_id' => 2,
                'title' => '1984',
                'author' => 'George Orwell',
                'publisher' => 'Secker & Warburg',
                'reason' => 'For academic research.',
                'status' => 'approved',
            ],
            [
                'member_id' => 3,
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'publisher' => 'J.B. Lippincott & Co.',
                'reason' => 'Recommended by my teacher.',
                'status' => 'pending',
            ],
        ];

        foreach ($requests as $request) {
            DB::table('book_requests')->insert(array_merge($request, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
