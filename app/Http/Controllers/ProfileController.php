<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }
    
    public function index()
    {
        $user = auth()->user();
        return view("profile", compact("user"));
    }

    public function update(Request $request)
    {
        $userId = auth()->user()->id;
    
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed',
            'image' => ["mimes:jpg,jpeg,png"], // don't add space between formats
        ]);

        // Check if a new password is provided
        if ($request->filled('password')) {
            // Hash the new password
            $data['password'] = Hash::make($request->input('password'));
        } else {
            // Remove the 'password' field from the data array if no new password is provided
            unset($data['password']);
        }

        // Store image
        if ($request->hasFile('image')) {
            $path = request('image')->store('users'); // Store image in database as users/image_name
            $data['image'] = $path;
        }

        User::where('id', $userId)->update($data);
    
        return redirect("/profile");
    }
}
