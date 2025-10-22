<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;

class ProfileController extends Controller
{
    // edit: 22 oktober 2025 pukul 15:54 WIB
    // public function index()
    // {
    //     $user = Auth::user();
    //     $member = Member::where('user_id', $user->id)->first();
    //     return view('user.profile', compact('user', 'member'));
    // }

    // public function edit()
    // {
    //     $user = Auth::user();
    //     $member = Member::where('user_id', $user->id)->first();
    //     return view('user.profile_edit', compact('user', 'member'));
    // }

    // public function update(Request $request)
    // {
    //     $user = Auth::user();
    //     $member = Member::where('user_id', $user->id)->first();

    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'address' => 'nullable|string|max:255',
    //         'phone' => 'nullable|string|max:20',
    //         'password' => 'nullable|min:6|confirmed',
    //         'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     $user->name = $validated['name'];
    //     $user->email = $validated['email'];

    //     // password (optional)
    //     if (!empty($validated['password'])) {
    //         $user->password = Hash::make($validated['password']);
    //     }

    //     // foto
    //     if ($request->hasFile('profile_picture')) {
    //         $filename = time() . '.' . $request->file('profile_picture')->extension();
    //         $request->file('profile_picture')->storeAs('public/profile_pictures', $filename);
    //         $user->profile_picture = $filename;
    //     }

    //     $user->save();

    //     if ($member) {
    //         $member->update([
    //             'address' => $validated['address'] ?? $member->address,
    //             'phone' => $validated['phone'] ?? $member->phone,
    //         ]);
    //     }

    //     return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    // }


    // revisi setelahnya
    public function index()
    {
        $user = Auth::user(); // ambil data dari users_cred (model Login)
        $member = Member::where('user_id', $user->id)->first();
        return view('user.profile', compact('user', 'member'));
    }

    public function edit()
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        return view('user.profile_edit', compact('user', 'member'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users_cred,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data user (tabel users_cred)
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Update data member (tabel members)
        if ($member) {
            // Jika ada file foto baru
            if ($request->hasFile('profile_picture')) {
                $filename = time() . '.' . $request->file('profile_picture')->extension();
                $request->file('profile_picture')->storeAs('public/profile_pictures', $filename);
                Storage::disk('public')->putFileAs('profile_pictures', $request->file('profile_picture'), $filename);
                $member->profile_picture = $filename;
            }

            $member->address = $validated['address'] ?? $member->address;
            $member->phone = $validated['phone'] ?? $member->phone;
            $member->save();
        }

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}
