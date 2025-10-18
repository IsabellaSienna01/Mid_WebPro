<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoanDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loanDetails = [
                [
                    'loan_id' => 1,
                    'book_id' => 1, 
                    'quantity' => 1,
                ],
                [
                    'loan_id' => 1,
                    'book_id' => 2,
                    'quantity' => 2,
                ],
                [
                    'loan_id' => 2,
                    'book_id' => 3,
                    'quantity' => 1,
                ],
                [
                    'loan_id' => 3,
                    'book_id' => 2,
                    'quantity' => 1,
                ],
            ];

            foreach ($loanDetails as $detail) {
                DB::table('loan_details')->insert(array_merge($detail, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]));
            }
    }
}
