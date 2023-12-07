<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SystemController extends Controller
{
    public function show_sys_setting()
    {
        $system_data = SystemSetting::first();
        return view('pages.system_settings', compact('system_data'));
    }

    public function save_system_setting(Request $request)
    {
        $default_img = MediaFile::first();
        $system_data = SystemSetting::first();
        $image = $request->file('logo');

        if(isset($image))
        {
            if($default_img->file_name != $system_data->logo)
            {
                $file_path = public_path('uploads/system-logo/'.$system_data->logo);
                if (File::exists($file_path))
                {
                    File::delete($file_path);
                }
            }

            $imageName = time().".".$image->getClientOriginalExtension();
            $image->move(public_path('uploads/system-logo'),$imageName);
        }else
        {
            $imageName = $system_data->logo;
        }

        if (
            $system_data->title != $request->system_title ||
            $system_data->footer_title != $request->footer_title ||
            $system_data->logo != $imageName
        ) {
            $system_data->title = $request->system_title;
            $system_data->footer_title = $request->footer_title;
            $system_data->logo = $imageName;

            $system_data->update();
            return redirect('/system-settings')->with('success', 'System Setting has been updated!');
        }

        return redirect()->back()->with('info', 'No changes were made');

    }
}
