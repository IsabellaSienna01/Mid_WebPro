<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Fine;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member.login', 'loanDetails.book', 'fines'])
                    ->orderBy('loan_date', 'desc')
                    ->paginate(20);

        return view('admin.loans.index', compact('loans'));
    }

    public function editFine(Fine $fine)
    {
        return view('admin.loans.edit', compact('fine'));
    }

    public function updateFine(Request $request, Fine $fine)
    {
        $request->validate([
            'paid' => 'required|boolean',
        ]);

        $fine->update([
            'paid' => $request->paid,
        ]);

        return redirect()->route('admin.loans.index')
                        ->with('success', 'Fine updated successfully.');
    }
}
