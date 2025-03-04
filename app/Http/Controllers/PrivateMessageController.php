<?php
namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use App\Models\User;
use Illuminate\Http\Request;

class PrivateMessageController extends Controller
{
    // Show the messaging page with sent and received messages
    public function index(Request $request)
    {
        $currentUser = auth()->user();
    
        // Users with whom the logged-in user has exchanged messages
        $usersWithMessages = \App\Models\User::whereHas('sentPrivateMessages', function ($query) use ($currentUser) {
            $query->where('receiver_id', $currentUser->id);
        })->orWhereHas('privateMessages', function ($query) use ($currentUser) {
            $query->where('sender_id', $currentUser->id);
        })->get();
    
        // All users except the logged-in user
        $allUsers = \App\Models\User::where('id', '!=', $currentUser->id)->get();
    
        // Selected user (if any)
        $selectedUserId = $request->input('user_id');
        $messages = [];
        if ($selectedUserId) {
            $messages = \App\Models\PrivateMessage::where(function ($query) use ($currentUser, $selectedUserId) {
                $query->where('sender_id', $currentUser->id)->where('receiver_id', $selectedUserId);
            })->orWhere(function ($query) use ($currentUser, $selectedUserId) {
                $query->where('sender_id', $selectedUserId)->where('receiver_id', $currentUser->id);
            })->with('sender', 'receiver')->orderBy('created_at', 'asc')->get();
        }
    
        return view('messages.index', compact('usersWithMessages', 'allUsers', 'messages', 'selectedUserId'));
    }
    

    // Send a private message to another user
    public function store(Request $request)
{
    $request->validate([
        'receiver_id' => [
            'required',
            'exists:users,id', // Ensure the receiver exists in the users table
            function ($attribute, $value, $fail) {
                if ($value == auth()->id()) {
                    $fail('You cannot send a message to yourself.');
                }
            },
        ],
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
