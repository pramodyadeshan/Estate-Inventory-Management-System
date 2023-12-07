<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\SysSetting;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class RegisterController extends Controller
{
    public function load_user_data()
    {
        $user_role_records = UserRole::all();
        $states = State::all();
        return view('pages.user_manage.add_user',compact('user_role_records', 'states'));
    }
    public function register_users(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|unique:Users',
            'password' => 'required|string',
            'status' => 'required',
            'user_roles' => 'required',
            'state_id' => 'required|array'
        ],
        [
            'state_id.required' => 'Please select at least or one state name.',
        ]);

        if($request->file('profile_picture'))
        {
            $image = $request->file('profile_picture');
            $imageName = time().".".$image->getClientOriginalExtension();
            $image->move(public_path('uploads/user-profile-images'),$imageName);
        }else
        {
            $imageName = null;
        }
        $stateIdsJson = json_encode($request->state_id); //array conver to json

        $user = new User();
        $user->name = $request->full_name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->role_id = $request->user_roles;
        $user->image = $imageName;
        $user->state_id = $stateIdsJson;
        $user->current_state = 1;
        $user->unread_message = 0;
        $user->msg_sender_id = 0;

        $user->save();

        return redirect()->back()->with('success', 'User has been created!');
    }

    public function edit_user($id)
    {
        $user_data = User::find($id);
        $user_role_records = UserRole::all()->where('id','!=', $user_data->role_id);

        $userStateIds = json_decode($user_data->state_id, true); // Assuming state_id is stored as a JSON array
        $states = State::whereIn('id', $userStateIds)->get();
        $statesNotSelected = State::whereNotIn('id', $userStateIds)->get();
        return view('pages.user_manage.edit_user',compact('user_data', 'user_role_records', 'states','statesNotSelected'));
    }

    public function edit_auth_user(Request $request, $id)
    {
        $validate_data = $request->validate([
            'full_name' => 'required|string|max:255',
            'status' => 'required',
            'user_roles' => 'required',
            'state_id' => 'required|array'
        ],
        [
            'state_id.required' => 'Please select at least or one state name.',
        ]);

        if($request->file('profile_picture'))
        {
            $imagename = User::find($id)->image;
            $file_path = public_path('uploads/user-profile-images/'.$imagename);

            if (File::exists($file_path))
            {
                File::delete($file_path);
            }

            $image = $request->file('profile_picture');
            $imageName = time().".".$image->getClientOriginalExtension();
            $image->move(public_path('uploads/user-profile-images'),$imageName);
        }else
        {
            $imageName = $request->input('current_image');
        }

        $user = User::find($id);
        $user->name = $request->full_name;
        $user->status = $request->status;
        $user->role_id = $request->user_roles;
        $user->image = $imageName;

        if($request->username != null)
        {
            $user->username = $request->username;
        }

        $user->state_id = json_encode($request->state_id);

        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }

        if (
            $user->name != $validate_data['full_name'] ||
            $user->status != $validate_data['status'] ||
            $user->role_id != $validate_data['user_roles'] ||
            $user->state_id != $validate_data['state_id'] || $imageName != ''
        ) {
            $user->update();
            return redirect()->back()->with('success', 'User has been updated!');
        }
        return redirect()->back()->with('info', 'No changes were made');

    }
    public function delete_user($id)
    {
        if(Auth::user()->id != $id)
        {
            $imagename = User::find($id)->image;
            $file_path = public_path('uploads/user-profile-images/'.$imagename);

            if (File::exists($file_path))
            {
                File::delete($file_path);
            }
            User::destroy($id);
            return redirect()->back()->with('success', 'User has been deleted!');
        }else
        {
            return redirect()->back()->with('error', 'You cannot delete your account!');
        }
    }

    public function upload_profile_picture(Request $request, $page)
    {
        $user_id = Auth::user()->id;

        if($page == 'img')
        {

            if(isset(User::find($user_id)->image))
            {
                $imagename = User::find($user_id)->image;
                $file_path = public_path('uploads/user-profile-images/'.$imagename);

                if (File::exists($file_path))
                {
                    File::delete($file_path);
                }
            }

            $image = $request->file('profile_picture');
            $imageName = time().".".$image->getClientOriginalExtension();
            $image->move(public_path('uploads/user-profile-images'),$imageName);

            $user = User::find($user_id);
            $user->image = $imageName;
            $user->update();

            return redirect()->back()->with('success', 'Profile Picture has been updated!');
        }else if($page == 'name')
        {
            $request->validate([
                'profile_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            ]);

            $user = User::find(Auth::user()->id);
            $user->name = ucwords($request->profile_name);
            $user->update();

            return redirect()->back()->with('success', 'Profile Name has been updated!');

        }else if($page == 'password')
        {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->new_password);
            $user->update();
            return redirect()->back()->with('success', 'Profile Password has been updated!');
        }

    }

}
