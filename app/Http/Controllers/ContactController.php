<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Show the contact form
    public function show()
    {
        return view('contact');
    }

    // Handle form submission and send email to the admin
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send email to the admin
        Mail::raw($request->message, function ($message) use ($request) {
            $message->to('admin@example.com')
                    ->subject('New Contact Form Submission')
                    ->from($request->email, $request->name);
        });

        return redirect()->route('contact.show')->with('success', 'Your message has been sent!');
    }
}
