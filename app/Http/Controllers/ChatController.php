<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function list_user_chat($id)
    {
        $user_data = User::find($id);
        $chat_history = Chat::where(function ($query) use ($id) {
            $query->where('sender_id', Auth::user()->id)
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', Auth::user()->id);
        })->limit(40)->get();

        return view('pages.message_manage.list_user_message', compact('chat_history','user_data'));
    }

    public function send_message(Request $request, $id)
    {
        $chat = new Chat();
        $chat->date_time = date('Y-m-d H:i A');
        $chat->message = $request->message;
        $chat->sender_id = Auth::user()->id;
        $chat->receiver_id = $id;
        $chat->deliver_status = 0;

        $chat->save();

        $unread_msg = User::find($id);
        $unread_msg->unread_message = 1;
        $unread_msg->msg_sender_id = Auth::user()->id;
        $unread_msg->update();

        return redirect('/user-chat/'.$id);
    }

    public function unread_message($id)
    {
        $unread_msg = User::find(Auth::user()->id);
        $unread_msg->unread_message = 0;
        $unread_msg->update();

        return redirect('/user-chat/'.$id);
    }
}
