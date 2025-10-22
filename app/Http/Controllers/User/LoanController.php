<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function borrow(Request $request, $bookId)
    {
        $user = Auth::user();

        $member = $user->member ?? null;
        if (!$member) {
            return back()->with('error', 'You are not registered as a library member.');
        }

        $book = Book::findOrFail($bookId);

        if ($book->stock <= 0) {
            return back()->with('error', 'This book is currently unavailable.');
        }

        $activeLoan = Loan::where('member_id', $member->id)
            ->whereNull('return_date')
            ->first();

        if ($activeLoan) {
            $alreadyBorrowed = $activeLoan->loanDetails()
                ->where('book_id', $book->id)
                ->exists();

            if ($alreadyBorrowed) {
                return back()->with('error', 'You already borrowed this book and have not returned it yet.');
            }
        }

        $loan = $activeLoan ?? Loan::create([
            'member_id' => $member->id,
            'loan_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(7),
            'status' => 'borrowed',
            'fine' => 0,
        ]);

        LoanDetail::create([
            'loan_id' => $loan->id,
            'book_id' => $book->id,
            'quantity' => 1,
        ]);

        $book->decrement('stock');

        return back()->with('success', 'Book borrowed successfully!');
    }
}