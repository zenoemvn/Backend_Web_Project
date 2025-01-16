<?php
namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use App\Models\User;
use Illuminate\Http\Request;

class PrivateMessageController extends Controller
{
    // Show the messaging page with sent and received messages
    public function index()
{
    $user = auth()->user();
    $receivedMessages = PrivateMessage::where('receiver_id', $user->id)->with('sender')->latest()->get();
    $sentMessages = PrivateMessage::where('sender_id', $user->id)->with('receiver')->latest()->get();
    $users = \App\Models\User::where('id', '!=', auth()->id())->get(); // Get all users except the current user

    return view('messages.index', compact('receivedMessages', 'sentMessages', 'users'));
}


    // Send a private message to another user
    public function store(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id', // Validate that the recipient exists
        'content' => 'required|string|max:1000',
    ]);

    PrivateMessage::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $request->receiver_id,
        'content' => $request->content,
    ]);

    return redirect()->route('messages.index')->with('status', 'Message sent successfully!');
}

}
