<?php

namespace App\Http\Controllers;

use App\Models\ChatBot;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('pages.chat_bot.chat_bot');
    }

    public function sendMessage(Request $request)
    {
        $response = Http::post('http://127.0.0.1:5000/api/chat', [
            'message' => $request->input('message'),
        ]);

        $botResponse = $response->json()['message'];

        return view('pages.chat_bot.chat_bot')->with('botResponse', $botResponse);
    }

    public function add_chat_bots(Request $request)
    {

        $request->validate([
            'keyword' => 'required',
            'response' => 'required',
        ]);

        $chat_bot = new ChatBot();
        $chat_bot->keyword = $request->keyword;
        $chat_bot->response = $request->response;

        $chat_bot->save();

        return redirect('/manage-chat-bot')->with('success', 'Chat Bot Data has been saved!');
    }

    public function list_chat_bots()
    {
        $list_chat_bots = ChatBot::orderBy('updated_at', 'desc')->get();
        return view('pages.chat_bot.chat_bot_manage', compact('list_chat_bots'));
    }

    public function update_chat_bot($id)
    {
        $chat_bot_record = ChatBot::find($id);
        return view('pages.chat_bot.edit_chat_bot_manage', compact('chat_bot_record'));
    }

    public function edit_auth_chat_bot(Request $request, $id)
    {
        $validate_data = $request->validate([
            'keyword' => 'required',
            'response' => 'required',
        ]);

        //Find & update Data
        $find_chat_bot = ChatBot::find($id);

        if (
            $find_chat_bot->keyword != $validate_data['keyword'] ||
            $find_chat_bot->response != $validate_data['response']
            ) {

            $chat_bot_keyword = $request->input('keyword');
            $chat_bot_response = $request->input('response');
           
            $find_chat_bot->keyword = $chat_bot_keyword;
            $find_chat_bot->response = $chat_bot_response;

            $find_chat_bot->update();

            return redirect()->back()->with('success', 'Chat bot Data has been updated!');
        }
        return redirect()->back()->with('info', 'No changes were made');
    }

    public function delete_chat_bot($id)
    {
        ChatBot::destroy($id);
        return redirect()->back()->with('success', 'Chat Bot Data has been deleted!');
    }
}
