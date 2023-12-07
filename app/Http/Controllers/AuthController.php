<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function add_user_role(Request $request)
    {
        $validate_data = $request->validate([
            'role_name' => 'required|string|unique:user_roles',
            'group_level' => 'required',
            'status' => 'required',
        ]);

        UserRole::create($validate_data);
        return redirect('/view-user-role')->with('success', 'User Role has been saved!');
    }

    public function list_user_role()
    {
        $user_roles = UserRole::orderBy('updated_at','desc')->get();
        return view('pages.user_manage.user_role', compact('user_roles'));
    }

    public function delete_user_role($id)
    {
        UserRole::destroy($id);
        //DB::table('user_roles')->where('id', $id)->delete();

        return redirect('list-user-role')->with('success', 'User Role has been deleted!!');
    }

    public function edit_user_role($id)
    {
        $user_role_record = UserRole::find($id);
        return view('pages.user_manage.edit_user_role', compact('user_role_record'));
    }

    public function edit_auth_user_role(Request $request, $id)
    {
        //Check validate, Role name check uniqueness in given id
        $validate_data = $request->validate([
            'role_name' => 'required|string|unique:user_roles,role_name,' . $id,
            'group_level' => 'required',
            'status' => 'required',
        ]);

        //Find & update Data
        $find_user_role = UserRole::find($id);

        if (
            $find_user_role->role_name != $validate_data['role_name'] ||
            $find_user_role->group_level != $validate_data['group_level'] ||
            $find_user_role->status != $validate_data['status']
        ) {
            $find_user_role->update($validate_data);
            return redirect()->back()->with('success', 'User Role has been updated!');
        }
        return redirect()->back()->with('info', 'No changes were made');
    }

    public function list_users()
    {
        $users = User::with('role')->orderBy('updated_at', 'desc')->paginate(10);
        $stateIds = $users->pluck('state_id')->flatten()->unique()->toArray();
        $states_data = State::all();

        return view('pages.user_manage.list_users', compact('users', 'states_data'));
    }

    public function switch_state(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->current_state = $request->state_id;
        $user->update();

        return redirect()->back();
    }

}
