<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $books = Book::latest()->take(8)->get();
        return view('landing.index', compact('books'));
    }

    public function detail($id)
    {
        $book = Book::findOrFail($id);
        return view('user.books.detail', compact('book'));
    }
}
