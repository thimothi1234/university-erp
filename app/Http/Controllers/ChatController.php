<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chat;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $chat = Chat::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($chat))->toOthers();

        return response()->json($chat);
    }

    public function fetch($userId)
    {
        return Chat::where(function ($q) use ($userId) {
            $q->where('from_user_id', auth()->id())
              ->where('to_user_id', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('from_user_id', $userId)
              ->where('to_user_id', auth()->id());
        })->get();
    }
}

