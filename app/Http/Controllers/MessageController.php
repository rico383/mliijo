<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $message = message::all();

        return view('people.message', compact('message'));
    }

    public function destroy(Request $request)
    {
        $message = $request->input('message');

        if (empty($message)) {
            return back()->with('error', 'Select the item first.');
        }

        foreach ($message as $messageId) {
            $message = message::findOrFail($messageId);

        $message->delete();
        }
        return back()->with('success', 'Message Deleted');
    }
}
