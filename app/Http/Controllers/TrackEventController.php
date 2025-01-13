<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventRecord;

class TrackEventController extends Controller
{
    /**
     * Update the user's performance record for a specific event.
     */
    public function update(Request $request)
    {
        $request->validate([
            'track_event_id' => ['required', 'exists:track_events,id'],
            'performance' => ['required', 'numeric'],
        ]);

        $user = Auth::user();

        // Save the new record to the event_records table
        EventRecord::create([
            'user_id' => $user->id,
            'track_event_id' => $request->track_event_id,
            'performance' => $request->performance,
        ]);

        return redirect()->route('dashboard')->with('status', 'Record updated successfully!');
    }
}
