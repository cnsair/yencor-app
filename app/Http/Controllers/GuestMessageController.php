<?php

namespace App\Http\Controllers;

use App\Models\GuestMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GuestMessageController extends Controller
{
    // 
    public function create()
    {
        return view('home.contact-us');
    }

    // Store guest messages
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10|max:1500',
        ]);

        GuestMessage::create($validatedData);

        return redirect()->back()->with('success', 'Thank you for your message! An admin will get back to you.');
    }

    // Display message to admin
    public function index()
    {
        $messages = GuestMessage::latest()->get();
        return view('admin.guest-msg', compact('messages'));
    }

    // Read message by admin
    public function show(GuestMessage $message)
    {
        // Check if message exists
        if (!$message) {
            return redirect()->back()->with('status', 'error');
        }

        // Toggle is_read read->1
        $message->is_read = 1;
        $message->update();

        return view('admin.read-guest-msg', compact('message'));
    }

    // Delete message by admin
    public function destroy($id)
    {
        $message = GuestMessage::findOrFail($id);
        $message->delete();
        return Redirect::route('admin.guest-msg.index', $message)
            ->with('status', 'success');
    }

    public function toggleRead(GuestMessage $message)
    {
        // Check if message exists
        if (!$message) {
            return redirect()->back()->with('status', 'error');
        }

        // Toggle the is_read status
        $message->is_read = !$message->is_read;
        $message->update();

        // return redirect()->back()->with('status', 'toggled');
        return redirect()->back()->with([
            'status' => 'toggled',
            'msg_id' => $message->id, // Store the updated row ID in the session
        ]);
    }
}
