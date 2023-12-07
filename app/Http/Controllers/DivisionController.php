<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Division;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DivisionController extends Controller
{
    public function add_divisions(Request $request)
    {

        $request->validate([
            'division_name' => 'required',
            'state' => 'required',
        ]);

        $division = new Division();
        $division->division_name = $request->division_name;
        $division->state_id = $request->state;

        $division->save();

        return redirect('/divi-manage')->with('success', 'Division has been saved!');
    }

    public function list_divisions()
    {
        $list_divisions = Division::with(['state'])-> orderBy('updated_at', 'desc')->get();
        $states = State::all();
        return view('pages.prod_manage.division.division_manage', compact('list_divisions', 'states'));
    }

    public function edit_division($id)
    {
        $division_record = Division::find($id);
        $states = State::all();
        return view('pages.prod_manage.division.edit_divi_manage', compact('division_record', 'states'));
    }

    public function edit_auth_division(Request $request, $id)
    {
        $validate_data = $request->validate([
            'division_name' => 'required',
        ]);

        //Find & update Data
        $find_division = Division::find($id);

        if ($find_division->division_name != $validate_data['division_name']) {

            $diviName = $request->input('division_name');
            $find_division->update(['division_name' => $diviName]);
            return redirect()->back()->with('success', 'Division has been updated!');
        }
        return redirect()->back()->with('info', 'No changes were made');
    }

    public function delete_division($id)
    {
        Division::destroy($id);
        return redirect()->back()->with('success', 'Division has been deleted!');
    }

    
}
