<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignee;
use App\Models\User;
use App\Models\Department;
use App\Models\User_info;
use App\Models\Position;
use App\Models\Prefix;
use App\Models\Suffix;
use App\Models\SignatoryAssign;
use App\Http\Controllers\AccessRightsController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

// use App\Models\Department;

use DB;

class AssigneeController extends Controller
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
        $prefix =  Prefix::all();
        $suffix =  Suffix::all();
        $position =  Position::all();
        $department  = Department::all();
        $sig  = SignatoryAssign::all();
        $assignee = DB::table('users')
            ->join('user__infos', 'users.id', '=', 'user__infos.user_id')
            ->join('assignees', 'users.id', '=', 'assignees.user_id')
            ->join('departments', 'departments.id', '=', 'assignees.department_id')
            ->join('positions', 'positions.id', '=', 'assignees.position_id')
            ->select('users.id AS uid','users.profile_image AS pr','users.name AS fullname','user__infos.contact AS no','user__infos.address AS addrss','positions.position AS pos','assignees.status AS st','user__infos.suffix AS s')
            ->get();
       
        $stu = User_info::where('user_id',Auth::user()->id);

        if(AccessRightsController::access_roole(Auth::user()->id,'2')->sig == '0' ){
            include '404.php';
        }else{
            return view('pages.assignee.index',compact('assignee','prefix','suffix','position','department','sig'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
           
    public function store(Request $request)
    {
        
        $request->validate([
            'firstname'         =>  'required|string',
            'lastname'          =>  'required|string',
            'middlename'        =>  'required|string',
            'contact'           =>  'required|integer|min:10',
            'department'        =>  'required|string',
            'position'          =>  'required|string',
            'role'              =>  'required|string',
            'signature_assign'  =>  'required|string',
            'address'           =>  'required|string',
            'email'             =>  'required|string',
            'password'          =>  'required|string'
        ]);

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
        $department = $request->input('department');
        $position = $request->input('position');
        $role = $request->input('role');
        $signature_assign = $request->input('signature_assign');
        $address = $request->input('address');
        $password = $request->input('password');
        $email = $request->input('email');

        $fullname = $firstname.'_'.$middlename.'_'.$lastname.'_signature';
        $n = "";
        if ($pre == "" && $suff != "") {
            $n = $firstname.' '.$middlename.' '.$lastname.'. '.$suff;
        }elseif ($suff == "" && $pre != "") {
            $n = $pre.'. '.$firstname.' '.$middlename.' '.$lastname;
        }elseif ($pre == "" && $suff == "") {
            $n = $firstname.' '.$middlename.' '.$lastname;
        }else{
             $n = $pre.'. '.$firstname.' '.$middlename.' '.$lastname.'. '.$suff;
        }

        $user = new User;
        $user->name =  $n;
        $user->email = $email;
        $user->profile_image = 'uploads/user.png';
        $user->password = Hash::make($password);
        $user->type = "2";
        $user->save();

        $getUser = User::where('email',$email)->first();

        $userId = $getUser->id;

        $User_info = new User_info;
        $User_info->user_id = $userId;
        $User_info->prefix = $prefixE;
       
        $User_info->firstname = $firstname;
        $User_info->middlename = $middlename;
        $User_info->lastname = $lastname;
        $User_info->suffix = $suffixE;
        $User_info->contact = $contact;
        $User_info->address = $address;
        
        $User_info->role = $role;

        $User_info->save();
        
        $assignee = new Assignee;
        $assignee->user_id = $userId;
        $assignee->position_id = $position;
        $assignee->department_id = $department;
        $assignee->signature_assign = $signature_assign;

        if ($request->has('sig_img')) {

            $image = $request->file('sig_img');
            $name = Str::slug($fullname);
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $newname = $name. '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/',$newname);

            $assignee->siganture_photo = $filePath;
        }
        
        $assignee->status = "1";
        $assignee->save();

       
        return redirect()->back()->with('success','Successfully add new assignee!');
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
        
        $user = User::find($id);

        $User_info = User_info::where('user_id',$id)->first();

        $assignee = Assignee::where('user_id',$id)->first();
        $position =  Position::where('id',$assignee->position_id)->first();
        $department  = Department::where('id',$assignee->department_id)->first();

        return response()->json([
            "fullname"=>$user->name,
            "email"=>$user->email,
            "firstname"=>$User_info->firstname,
            "middlename"=>$User_info->middlename,
            "lastname"=>$User_info->lastname,
            "prefix"=>$User_info->prefix,
            "suffix"=>$User_info->suffix,
            "contact"=>$User_info->contact,
            "address"=>$User_info->address,
            "role"=>$User_info->role,
            "signature_assign"=>$assignee->signature_assign,
            "position"=>$assignee->position_id,
            "department"=>$assignee->department_id
        ]);
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

        $request->validate([
            'firstname'         =>  'required|string',
            'lastname'          =>  'required|string',
            'middlename'        =>  'required|string',
            'contact'           =>  'required|integer|min:10',
            'department'        =>  'required|string',
            'position'          =>  'required|string',
            'role'              =>  'required|string',
            'signature_assign'  =>  'required|string',
            'address'           =>  'required|string',
            'email'             =>  'required|string',
        ]);
        $id = $request->input('id');
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
        $department = $request->input('department');
        $position = $request->input('position');
        $role = $request->input('role');
        $signature_assign = $request->input('signature_assign');
        $address = $request->input('address');
        $password = $request->input('password');
        $email = $request->input('email');

        $fullname = $firstname.'_'.$middlename.'_'.$lastname.'_signature';
        $n = "";
        if ($pre == "" && $suff != "") {
            $n = $firstname.' '.$middlename.' '.$lastname.'. '.$suff;
        }elseif ($suff == "" && $pre != "") {
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
            $request->validate([
            'password'  =>  'min:8'
            ]);        
            $user->password = Hash::make($password);
        }

        
        $user->update();

        

        $User_info = User_info::where('user_id',$id)->first();

        $User_info->prefix = $prefixE;
        $User_info->firstname = $firstname;
        $User_info->middlename = $middlename;
        $User_info->lastname = $lastname;
        $User_info->suffix = $suffixE;
        $User_info->contact = $contact;
        $User_info->address = $address;
       
        $User_info->role = $role;

        $User_info->update();
        
        $assignee = Assignee::where('user_id',$id)->first();
        $assignee->position_id = $position;
        $assignee->department_id = $department;
        $assignee->signature_assign = $signature_assign;

        if ($request->has('sig_img')) {

            $image = $request->file('sig_img');
            $name = Str::slug($fullname);
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $newname = $name. '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/',$newname);

            $assignee->siganture_photo = $filePath;
        }
        
        $assignee->update();

       
        return redirect()->back()->with('success','Successfully update assignee!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $id = $request->input('id');
        
        $user = User::where('id',$id)->first();

        $user->delete();

        $User_info = User_info::where('user_id',$id)->first();

        $User_info->delete();

        $assignee = Assignee::where('user_id',$id)->first();

        $assignee->delete();

        return redirect()->back()->with('success','Successfully delete assignee!');
    }

    public function status(Request $request)
    {   
        $id = $request->input('id');
        $st = "";
        if ($request->input('status') == "1") {
            $st = "activate";
        }else{
            $st = "deactivate";
        }
        $assignee = Assignee::where('user_id',$id)->first();
       
        $assignee->status = $request->input('status');
        $assignee->update();

        return redirect()->back()->with('success','Successfully '.$st.' assignee!');
    }
    public function sig()
    {
        return view('pages.sigpad');
    }
    public function upsig(Request $request)
    {
        $img = $request->get('img');

        $folderPath = "uploads/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '. '.$image_type;

        file_put_contents($file, $image_base64);

        move($file,$image_base64);

        echo 'ok';
    }
}
