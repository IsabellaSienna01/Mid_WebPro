<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Loan;
use App\Models\LoanDetail;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $member = $user->member;

        if (!$member) {
            return redirect()->route('landing.index')->with('error', 'You are not registered as a member.');
        }

        $recentLoans = Loan::where('member_id', $member->id)
            ->orderByDesc('loan_date')
            ->take(3)
            ->with('loanDetails.book')
            ->get();

        $activeLoans = Loan::where('member_id', $member->id)
            ->whereNull('return_date')
            ->with('loanDetails.book')
            ->get();

        $nearestDue = $activeLoans->sortBy('due_date')->first();

        $totalBorrowedBooks = LoanDetail::whereHas('loan', function ($q) use ($member) {
                $q->where('member_id', $member->id);
            })
            ->count();

        return view('user.dashboard', compact('recentLoans', 'activeLoans', 'nearestDue', 'totalBorrowedBooks'));
    }
}