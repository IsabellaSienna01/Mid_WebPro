<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $member = Auth::user()->member;

        $loans = Loan::where('member_id', $member->id)
            ->with('loanDetails.book')
            ->get();

        foreach ($loans as $loan) {
            if ($loan->is_overdue && $loan->return_date === null) {
                $loan->fine = $loan->calculateFine();
                $loan->save();
            }
        }

        return view('user.histories', compact('loans'));
    }
}