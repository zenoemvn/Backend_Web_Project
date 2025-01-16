<?php

namespace App\Http\Controllers;

use App\Models\ProfileMessage;
use Illuminate\Http\Request;

class ProfileMessageController extends Controller
{
    public function store(Request $request, $receiverId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        ProfileMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('status', 'Message posted on the profile!');
    }
}
