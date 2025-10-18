<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $loans = [
            [
                'member_id' => 1,
                'loan_date' => Carbon::now()->subDays(5),
                'due_date' => Carbon::now()->addDays(5),
                'return_date' => null,
                'fine' => 0,
                'status' => 'borrowed',
            ],
            [
                'member_id' => 2,
                'loan_date' => Carbon::now()->subDays(10),
                'due_date' => Carbon::now()->subDays(2),
                'return_date' => Carbon::now()->subDays(1),
                'fine' => 5000,
                'status' => 'returned',
            ],
            [
                'member_id' => 3,
                'loan_date' => Carbon::now()->subDays(7),
                'due_date' => Carbon::now()->subDays(1),
                'return_date' => null,
                'fine' => 0,
                'status' => 'late',
            ],
        ];

        foreach ($loans as $loan) {
            DB::table('loans')->insert(array_merge($loan, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
