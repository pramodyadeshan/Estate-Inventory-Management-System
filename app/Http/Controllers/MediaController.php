<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function list_media_file()
    {
        $user_id = Auth()->user()->id;
        $list_media_files = MediaFile::where('user_id',$user_id)->orderBy('created_at', 'desc')->paginate(24);

        $totalImages = MediaFile::where('user_id',$user_id)->count();
        return view('pages.prod_manage.media.media_file', compact('list_media_files','totalImages'));
    }
    public function upload_file(Request $request) {

        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif', // Example validation rules
        ]);

        $image = $request->file('file');
        $imageName = time().".".$image->getClientOriginalExtension();
        $fileType = $image->getClientMimeType();
        $image->move(public_path('uploads/product-images'),$imageName);

        $MediaFile = new MediaFile();
        $MediaFile->file_name = $imageName;
        $MediaFile->file_type = $fileType;
        $MediaFile->user_id = Auth()->user()->id;
        $MediaFile->save();

        return response()->json(['success'=>$imageName]);
    }

    public function delete_media_file($id)
    {
        $user_id = Auth()->user()->id;

        $check_image_name = MediaFile::find($id);

        if (!$check_image_name) {
            return redirect()->back()->with('error', 'Media file not found.');
        }

        $file_path = public_path('uploads/product-images/' . $check_image_name->file_name);

        MediaFile::where('id', $id)->delete();

        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        $list_media_files = MediaFile::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(24);

        $totalImages = MediaFile::where('user_id', $user_id)->count();

        return view('pages.prod_manage.media.media_file', compact('list_media_files', 'totalImages'));
    }


}
