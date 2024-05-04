<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatStoreRequest;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class ChatController extends Controller
{
    public function show($id) {
        $otherUser = User::find($id);

        return view("chats.show",
            [
            'otherUser' => $otherUser
            ]);
    }

    public function store(Request $request, $id) {
        $validatedRequest = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $msg = new Message();
        $msg->msg = $validatedRequest['message'];
        $msg->sender_id = auth()->user()->getAuthIdentifier();
        $msg->receiver_id = $id;
        $msg->save();
    }
    public function retrieve($otherUser_Id) {
        $currentUser = auth()->user();
        $otherUser = User::find($otherUser_Id);
        $you = Message::where('sender_id', $currentUser->getAuthIdentifier())->where('receiver_id', $otherUser->id)->orderBy("sent_at", "ASC")->get();
        $other = Message::where('sender_id', $otherUser->id)->where('receiver_id', $currentUser->getAuthIdentifier())->orderBy("sent_at", "ASC")->get();

        $messages = $you->merge($other);

        $messages = $messages->sortBy('sent_at');


        $formattedMessages = $messages->map(function ($message) use ($currentUser, $otherUser) {
            $sender = $message->sender_id === $currentUser->getAuthIdentifier() ? 'You' : $otherUser->name;
            return [
                'sender' => $sender,
                'message' => $message->msg,
                'sent_at' => $message->sent_at
            ];
        });

        return view("chats.chat_box", ['messages' => $formattedMessages, 'otherUser' => $otherUser]);
    }
}
