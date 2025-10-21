<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recommendedBooks = [
            (object) ['title' => 'Laravel Unlocked', 'author' => 'John Doe', 'id' => 1],
            (object) ['title' => 'Mastering PHP', 'author' => 'Jane Smith', 'id' => 2],
        ];

        $recentHistories = [
            (object) ['book' => (object)['title' => 'Algoritma Pemrograman'], 'borrow_date' => '2025-10-10', 'return_date' => null, 'status' => 'borrowed'],
            (object) ['book' => (object)['title' => 'Struktur Data'], 'borrow_date' => '2025-09-22', 'return_date' => '2025-10-02', 'status' => 'returned'],
        ];

        return view('user.dashboard', compact('recommendedBooks', 'recentHistories'));
    }
}
