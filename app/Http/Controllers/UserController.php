<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Search method
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search users by name or email
        $users = User::where('name', 'LIKE', "%{$query}%")
                     ->orWhere('email', 'LIKE', "%{$query}%")
                     ->get();

         // Pass users to the view
        return view('dashboard', compact('users'));

    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        $isOwner = auth()->id() === $user->id;
    
        return view('profile.show', compact('user', 'isOwner'));
    }
    


}
