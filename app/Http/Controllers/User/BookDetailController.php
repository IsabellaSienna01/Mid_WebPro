<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BookDetailController extends Controller
{
    public function detail($id)
    {
        $book = Book::with('category')->findOrFail($id);
        $user = Auth::user();

        $alreadyBorrowed = false;

        if ($user && $user->member) {
            $alreadyBorrowed = LoanDetail::whereHas('loan', function ($query) use ($user) {
                $query->where('member_id', $user->member->id)
                    ->whereNull('return_date');
            })
            ->where('book_id', $id)
            ->exists();
        }

        return view('user.books.detail', compact('book', 'alreadyBorrowed'));
    }
}