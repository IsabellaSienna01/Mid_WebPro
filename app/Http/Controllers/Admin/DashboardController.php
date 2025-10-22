<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        // Buat statistik
        $stats = [
            'books' => Book::count(),
            'members' => Member::count(),
            'borrowed' => Loan::where('status', 'borrowed')->count(),
            'returned' => Loan::where('status', 'returned')->count(),
        ];

        // Ambil aktivitas terbaru
        $recentActivities = Loan::with('loanDetails.book', 'member')
            ->latest()
            ->take(5)
            ->get();

        // Kirim ke view
        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}
