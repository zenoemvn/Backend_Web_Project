<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function editUsers()
    {
        $users = User::all();

        return view('admin.edit-users', compact('users'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'usertype' => 'required|in:user,admin',
        ]);

        $user->usertype = $request->usertype;
        $user->save();

        return redirect()
            ->route('admin.editusers')
            ->with('status', 'User updated successfully!');
    }
    public function storeUser(Request $request)
    {
        // Validate the inputs (feel free to expand these rules)
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'usertype' => 'required|in:user,admin',
        ]);

        // Create the user
        $user = new User;
        $user->name     = $validated['name'];
        $user->email    = $validated['email'];
        $user->password = Hash::make($validated['password']); // important: hash the password
        $user->usertype = $validated['usertype'];
        $user->save();

        return redirect()
            ->route('admin.editusers')
            ->with('status', 'New user created successfully!');
    }
}
