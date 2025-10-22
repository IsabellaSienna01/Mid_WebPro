<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $member = $user->member;

        if (!$member) {
            return back()->with('error', 'You are not registered as a library member.');
        }

        $book = Book::findOrFail($bookId);

        if ($book->stock < 1) {
            return back()->with('error', 'This book is currently unavailable.');
        }

        $alreadyBorrowed = LoanDetail::where('book_id', $book->id)
            ->whereHas('loan', function ($query) use ($member) {
                $query->where('member_id', $member->id)
                      ->whereNull('return_date'); // artinya masih aktif
            })
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'You have already borrowed this book and not yet returned it.');
        }

        $loan = Loan::Create(
            [
                'member_id' => $member->id,
                'return_date' => null,
                'loan_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays(7),
                'status' => 'borrowed',
                'fine' => 0
            ]
        );

        LoanDetail::create([
            'loan_id' => $loan->id,
            'book_id' => $book->id,
            'quantity' => 1
        ]);

        $book->decrement('stock');

        return back()->with('success', 'Book borrowed successfully!');
    }

    public function return($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->member->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($loan->return_date) {
            return redirect()->back()->with('error', 'This book has already been returned.');
        }

        $loan->update([
            'return_date' => Carbon::now(),
            'status' => 'returned',
        ]);

        return redirect()->back()->with('success', 'Book returned successfully!');
    }
}