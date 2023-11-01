<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignee;
use App\Models\User;
use App\Models\Department;
use App\Models\User_Info;
use App\Models\Position;
use App\Models\Prefix;
use App\Models\Suffix;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MyprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $prefix =  Prefix::all();
        $suffix =  Suffix::all();

        $User_Info = User_Info::where('user_id',$id)->first();
        $assignee = Assignee::where('user_id',$id)->first();

        return view('pages.my_profile.index',compact('prefix','suffix','User_Info','assignee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $id = auth()->user()->id;
        $prefixE = "";
        $prefixE1 = "";

        $suffixE = "";
        $suff="";
        $pre="";

        $prefix1 = "";
        $prefix = $request->input('prefix'); 
        if ($prefix !="") {
            $prefix1 = json_encode($request->input('prefix')); 
            $prefixE=implode(',',$prefix);
            $pre = str_replace(',', '. ', $prefixE); 
        }       
        
        $suffix1 = "";
        $suffix = $request->input('suffix');
        if ($suffix != "") {
            $suffix1 = json_encode($request->input('suffix'));
            $suffixE = implode(',',$suffix);
            $suff = str_replace(',', '. ', $suffixE); 
        }

        $firstname = $request->input('firstname');
        $contact = $request->input('contact');
        $middlename = $request->input('middlename');
        $lastname = $request->input('lastname');
        $address = $request->input('address');
        $password = $request->input('password');
        $email = $request->input('email');

        $fullname = $firstname.'_'.$middlename.'_'.$lastname.'_signature';
        $n = "";
        if ($pre == "") {
            $n = $firstname.' '.$middlename.' '.$lastname.'. '.$suff;
        }elseif ($suff == "") {
            $n = $pre.'. '.$firstname.' '.$middlename.' '.$lastname;
        }elseif ($pre == "" && $suff == "") {
            $n = $firstname.' '.$middlename.' '.$lastname;
        }else{
             $n = $pre.'. '.$firstname.' '.$middlename.' '.$lastname.'. '.$suff;
        }

        $user =  User::find($id);
        $user->name =  $n;
        $user->email = $email;

        if ($password != "") {            
            $user->password = Hash::make($password);
        }

        
        $user->update();



        $User_Info = User_Info::where('user_id',$id)->first();

        $User_Info->prefix = $prefixE;
        $User_Info->firstname = $firstname;
        $User_Info->middlename = $middlename;
        $User_Info->lastname = $lastname;
        $User_Info->suffix = $suffixE;
        $User_Info->contact = $contact;
        $User_Info->address = $address;

        $User_Info->update();
        
        $assignee = Assignee::where('user_id',$id)->first();

        if ($request->has('sig_img')) {

            $image = $request->file('sig_img');
            $name = Str::slug($fullname);
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $newname = $name. '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/',$newname);

            $assignee->siganture_photo = $filePath;

            $assignee->save();
        }
        
       
        
      
       
        return redirect()->back()->with('success','Successfully update your information!');
    }

    public function updateProfile(Request $request)
    {
       
        // $request->validate([
        //     'name'              =>  'required',
        //     'profile_image'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);

        $user = User::findOrFail(auth()->user()->id);

        if ($request->has('profile_image')) {
            $image = $request->file('profile_image');
            $name = Str::slug(auth()->user()->name).'_profile';
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $newname = $name. '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/',$newname);
            $user->profile_image = $filePath;

            $user->save();

            return redirect()->back()->with('success','Successfully update your profile picture!');
        }else{
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
