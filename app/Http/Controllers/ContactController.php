<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Send email (configure Mail in .env)
        try {
        // Send email (configure Mail in .env)
        Mail::to(config('mail.from.address'))
            ->send(new ContactFormSubmission(
                $request->name,
                $request->email,
                $request->subject,
                $request->message
            ));

            // Flash success message
            session()->flash('status', 'Your message has been sent!');
        } catch (\Exception $e) {
            // Flash error message if email fails
            Log::error('Contact form email failed: ' . $e->getMessage());
            session()->flash('error', 'Failed to send your message. Please try again.');
        }

        // session()->flash('message', 'Your message has been sent!');
        
        return redirect()->route('contact');
    }
}
