<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('users/edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'region_id' => 'nullable',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->has('image')) {
            // Store image
            $validatedData['image'] = $request->file('image')->store('public/Media-Css');
        }
        $user->update($validatedData);
        
        return redirect()->route('homepage')->with('status', 'Profile updated successfully');
    }
}
