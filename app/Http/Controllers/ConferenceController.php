<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConferenceController extends Controller
{
    public function list_conference()
    {
        Conference::where('user_id', Auth::user()->id)->update(['unread' => 0]);;

        $conferences = Conference::with(['user'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('pages.conf_manage.list_conference_link', compact('conferences'));
    }

    public function add_conference_form()
    {
        $users = User::all();
        return view('pages.conf_manage.add_conference_link', compact('users'));
    }
}
