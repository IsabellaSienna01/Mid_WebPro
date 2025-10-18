<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Login;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = Login::where('role', 'user')->get();

        foreach ($users as $user) {
            $exists = DB::table('members')->where('user_id', $user->id)->exists();
            if ($exists) {
                continue;
            }

            DB::table('members')->insert([
                'user_id' => $user->id,
                'address' => 'ITS Street No.' . rand(1, 100),
                'phone' => '0812' . rand(10000000, 99999999),
                'membership_date' => Carbon::now()->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
