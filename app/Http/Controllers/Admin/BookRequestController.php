<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRequest;
use App\Models\Book; // optional

class BookRequestController extends Controller
{
    public function index()
    {
        $requests = BookRequest::with('member.login')
            ->latest()
            ->paginate(20);

        return view('admin.request-book', compact('requests'));
    }

    public function update(Request $request, BookRequest $bookRequest)
    {
        $action = $request->input('action');

        if (! in_array($action, ['approved', 'rejected'])) {
            return back()->with('error', 'Invalid action');
        }

        $bookRequest->status = $action;
        $bookRequest->save();

        return back()->with('success', 'Request has been ' . $action . '.');
    }
}
