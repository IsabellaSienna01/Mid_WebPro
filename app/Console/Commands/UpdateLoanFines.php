<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use Carbon\Carbon;

class UpdateLoanFines extends Command
{
    protected $signature = 'loans:update-fines';
    protected $description = 'Update fines and overdue status for all active loans';

    public function handle()
    {
        $ratePerDay = 1000;
        $now = Carbon::now();

        $loans = Loan::whereNull('return_date')->get();
        $count = 0;

        foreach ($loans as $loan) {
            if ($loan->due_date->isPast()) {
                $daysLate = $now->diffInDays($loan->due_date);
                $fine = $daysLate * $ratePerDay;

                $loan->update([
                    'status' => 'late',
                    'fine' => $fine,
                ]);

                $count++;
            }
        }

        $this->info("Updated fines for {$count} overdue loans.");
        return Command::SUCCESS;
    }
}