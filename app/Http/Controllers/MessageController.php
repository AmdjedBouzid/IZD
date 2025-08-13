<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * Display all messages.
     */
    public function index()
    {
        try {
            $messages = Message::all();
            $metadata = Metadata::first(); 
            return view('messages', compact('messages', 'metadata'));
        } catch (\Throwable $e) {
            Log::error('Failed to fetch messages: ' . $e->getMessage());
            return back()->with('error', 'Unable to load messages.');
        }
    }

   
    /**
     * Store a new message.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'from' => 'required|string|max:255',
            'object' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        try {
            Message::create($data);

            return back()
                ->with('success', 'Message sent successfully.');

        } catch (\Throwable $e) {
            Log::error('Message creation failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Something went wrong while sending the message.');
        }
    }

    /**
     * Delete a message.
     */
    public function destroy($id)
    {
        try {
            $message = Message::findOrFail($id);
            $message->delete();

            return redirect()
                ->route('messages.index')
                ->with('success', 'Message deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Failed to delete message: ' . $e->getMessage());
            return back()->with('error', 'Unable to delete the message.');
        }
    }
}
