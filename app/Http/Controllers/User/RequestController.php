<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $member = $user->member;

        if (!$member) {
            return redirect()->route('landing.index')->with('error', 'You are not registered as a library member.');
        }

        $requests = BookRequest::where('member_id', $member->id)
            ->latest()
            ->get();

        return view('user.request-book', compact('requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'reason' => 'required|string|max:500',
        ]);

        $user = Auth::user();
        $member = $user->member;

        if (!$member) {
            return redirect()->route('landing.index')->with('error', 'You are not registered as a library member.');
        }

        BookRequest::create([
            'member_id' => $member->id,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('user.book.request')->with('success', 'Your book request has been submitted successfully!');
    }
}