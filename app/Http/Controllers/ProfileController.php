<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assignee;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.profile');
    }

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

    public function updateProfile(Request $request)
    {
       
        // $request->validate([
        //     'name'              =>  'required',
        //     'profile_image'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);

        $user = User::findOrFail(auth()->user()->id);

        $user->name = $request->input('name');

        if ($request->has('profile_image')) {
            $image = $request->file('profile_image');
            $name = Str::slug($request->input('name')).'_profile';
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $newname = $name. '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/',$newname);
            $user->profile_image = $filePath;
        }
        $user->save();

        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }
    public function imgpath(Request $request)
    {
        

            // $ext = $im->extension();
            // if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
                // $data = file_get_contents($im);
                // $base64 = 'data:image/jpeg;base64'.base64_encode($data);
                // file_put_contents("uploads/images/".'.'.$ext, $base64);
              
                // return response()->json($base64, 201);
            // }

            $user = Assignee::where('user_id',auth()->user()->id)->first();

            $id = $request->id;

            $name = $request->name;

            $folderPath = "uploads/images/"; //path location
            
            $image_parts = explode(";base64,", $id);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
       
            $file = $folderPath . $name .'_signature'. '.'.$image_type;

            file_put_contents($file, $image_base64);

            $user->siganture_photo = $file;
            $user->save();

            echo '1';

    }
}
