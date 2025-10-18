<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $fines = [
            [
                'loan_id' => 2, // sesuai loan yang sudah dikembalikan tapi kena denda
                'amount' => 5000,
                'paid' => false,
            ],
            [
                'loan_id' => 3, // pinjaman terlambat
                'amount' => 10000,
                'paid' => false,
            ],
        ];

        foreach ($fines as $fine) {
            DB::table('fines')->insert(array_merge($fine, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
