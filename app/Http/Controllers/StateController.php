<?php

namespace App\Http\Controllers;

use App\Models\State;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class StateController extends Controller
{
    public function add_states(Request $request)
    {
        $request->validate([
            'state_name' => 'required',
        ]);

        $stateName = $request->input('state_name');
        State::create(['state_name' => $stateName]);
        return redirect('/state-manage')->with('success', 'State has been saved!');
    }

    public function list_states()
    {
        $list_states = State::orderBy('updated_at', 'desc')->get();
        return view('pages.prod_manage.state.state_manage', compact('list_states'));
    }

    public function edit_state($id)
    {
        $state_record = State::find($id);
        return view('pages.prod_manage.state.edit_state_manage', compact('state_record'));
    }

    public function edit_auth_state(Request $request, $id)
    {
        $validate_data = $request->validate([
            'state_name' => 'required',
        ]);

        //Find & update Data
        $find_state = State::find($id);

        if ($find_state->state_name != $validate_data['state_name']) {

            $stateName = $request->input('state_name');
            $find_state->update(['state_name' => $stateName]);
            return redirect()->back()->with('success', 'State has been updated!');
        }
        return redirect()->back()->with('info', 'No changes were made');
    }

    public function delete_state($id)
    {
        State::destroy($id);
        return redirect()->back()->with('success', 'State has been deleted!');
    }
}
